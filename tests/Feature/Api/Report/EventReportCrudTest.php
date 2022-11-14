<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Author;
use App\Models\Day;
use App\Models\Player;
use App\Models\EventChip;
use App\Models\ImageTheme;
use App\Models\EventReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('cannot create reports if unauthenticated', function () {
    $this->post('admin/report/', [
        'title' => 'adrian',
    ])->assertStatus(302);
});

it('cannot enter the site if there is no event session', function () {
    superAdminAuthenticate();
    $this->get('admin/report/create')->assertStatus(403);
});


it('can insert reports if authenticated', function () {
    superAdminAuthenticate();
    $day = Day::factory()->create();

    $this->get('admin/report/create?event='.$day->event_id.'&day='.$day->id)->assertStatus(200);
    $this->post('/admin/report', EventReport::factory()->make([
        'title' => 'A report',
        'day_id' => $day->id,
        'level' => Level::factory()->create(),
    ])->attributesToArray());

    $this->assertDatabaseHas('event_reports', ['title' => 'A report']);
});


it('can update reports if authenticated', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $playerId = Player::factory()->create();


    $event = Event::factory()->create();

    $eventChip2 = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 1,
    ]);

    $event_id = Day::find($eventChip2->day_id)->event_id;

    $page = $this->get('admin/report/create?event='.$event_id.'&day='.$eventChip2->day_id)->assertStatus(200);

    // $data = [
    //     'title' => 'A report',
    //     'content' => 'this a content',
    //     'day' => '1A',
    //     'level_id' => Level::factory()->create()->id,
    //     'level' => Level::factory()->create(),
    //     'image_theme_id' => ImageTheme::factory()->create()->id,
    //     'event_id' => $event->id,
    //     'poker_event_id' => Event::factory()->create()->id,
    //     'published_date' => '2021-02-02 00:00:00',
    //     'user_id' => User::factory()->create()->id,
    //     'author_id' => Author::factory()->create()->id,
    //     'players' => $eventChip->get()->toArray(),
    // ];



    $data = EventReport::factory()->make([
        'title' => 'A report',
        'day_id' => $eventChip2->day_id,
        'level' => Level::factory()->create(),
        'published_date' => Carbon::now()
    ]);


    $datas = $this->post('/admin/report', $data->attributesToArray());


    $this->assertDatabaseHas('event_reports', ['title' => 'A report',

    ]);

    // $this->get('admin/report/'.EventReport::latest()->first()->id.'/edit')->assertStatus(200);

    // $data = [
    //     'id' => EventReport::latest()->first()->id,
    //     'title' => 'testreport',
    //     'content' => EventReport::latest()->first()->content,
    //     'day' => EventReport::latest()->first()->day,
    //     'level' => Level::factory()->create()->id,
    // ];

    // $datas = $this->put('admin/report/update', $data);

    // $this->assertDatabaseHas('event_reports', ['title' => 'testreport',
    // ]);
});

it('can delete report if authenticated', function () {
    $this->withoutExceptionHandling();
    superAdminAuthenticate();

    $article = EventReport::factory()->create();

    expect(EventReport::all()->count())->toBe(1);

    $this->get('admin/report')->assertStatus(200);
    $datas = $this->delete('admin/report/'.$article->id);
    expect(EventReport::all()->count())->toBe(0);
});
