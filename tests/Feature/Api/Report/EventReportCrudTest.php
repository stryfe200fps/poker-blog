<?php

use App\Models\ArticleAuthor;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\ImageTheme;
use App\Models\Level;
use App\Models\Player;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('chip counts update with isolated payout', function () {
    $this->withoutExceptionHandling();
    superAdminAuthenticate();

    $playerId = Player::factory()->create();

    $event = Event::factory()->create();

    $level = Level::factory()->create([
        'event_id' => $event->id,
    ]);

    $eventChip = EventChip::factory()->create([
        'event_id' => $event->id,
        'player_id' => $playerId->id,
    ]);

    $page = $this->get('admin/report/create?event='.$event->id)->assertStatus(200);

    $data = [
        'title' => 'A report unique',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => $level->id,
        'level' => $level,
        'event_id' => $event->id,
        'date_added' => '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
    ];

    $datas = $this->post('/admin/report', $data);

    $dd = $datas->getRequest()->request->get('title');

    $eventReport = EventReport::where('title', $dd)->first();

    $this->get('admin/report/'.$eventReport->id.'/edit')->assertStatus(200);

    $data = [
        'id' => $eventReport->id,
        'title' => 'testreport',
        'content' => $eventReport->content,
        'level' => $level->id,
        'day' => 5,
        'players' => [array_merge($eventChip->get()->toArray()[0], ['payout' => 50000])],
    ];

    $datas = $this->put('admin/report/update', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'testreport']);

    $this->assertDatabaseHas('event_payouts', ['event_id' => $event->id,
    ]);
});

test('chip counts is working with isolated payout field', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();
    $event = Event::factory()->create();

    $page = $this->get('admin/report/create?event='.$event->id)->assertStatus(200);

    $playerId = Player::factory()->create();
    $eventChip = EventChip::factory()->create([
        'player_id' => $playerId->id,
    ]);

    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added' => '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
        'players' => [array_merge($eventChip->get()->toArray()[0], ['payout' => 50000])],
    ];

    $datas = $this->post('/admin/report', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);

    $this->assertDatabaseHas('event_payouts', ['event_id' => $event->id,
    ]);
});

it('cannot create reports if unauthenticated', function () {
    $this->post('admin/report/', [
        'title' => 'adrian',
    ])->assertStatus(302);
});

it('cannot enter the site if there is no event session', function () {
    superAdminAuthenticate();
    $this->get('admin/report/create')->assertStatus(403);
});

it('can enter the site if there is event session', function () {
    superAdminAuthenticate();

    $event = Event::factory()->create();
    $page = $this->get('admin/report?event='.$event->id);

    $page->assertStatus(200);
    $page->assertSee($event->title);
});

it('can insert reports if authenticated', function () {
    $this->withoutExceptionHandling();
    superAdminAuthenticate();
    $event = Event::factory()->create();

    $page = $this->get('admin/report/create?event='.$event->id)->assertStatus(200);

    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'image_theme_id' => ImageTheme::factory()->create()->id,
        'date_added' => '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
    ];

    $datas = $this->post('/admin/report', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);
});

it('can insert reports with event chips players', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();
    $event = Event::factory()->create();

    $page = $this->get('admin/report/create?event='.$event->id)->assertStatus(200);

    $playerId = Player::factory()->create();
    $eventChip = EventChip::factory()->create([
        'player_id' => $playerId->id,
        'is_whatsapp' => 1,
    ]);

    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'event_id' => $event->id,
        'image_theme_id' => ImageTheme::factory()->create()->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added' => '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
        'players' => $eventChip->get()->toArray(),
    ];

    $datas = $this->post('/admin/report', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);
});

it('can update reports if authenticated', function () {
    $this->withoutExceptionHandling();
    superAdminAuthenticate();

    $playerId = Player::factory()->create();
    $eventChip = EventChip::factory()->create([
        'player_id' => $playerId->id,
        'is_whatsapp' => 1,
    ]);

    $event = Event::factory()->create();
    $page = $this->get('admin/report/create?event='.$event->id)->assertStatus(200);

    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'image_theme_id' => ImageTheme::factory()->create()->id,
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added' => '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
        'players' => $eventChip->get()->toArray(),
    ];

    $datas = $this->post('/admin/report', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);

    $this->get('admin/report/'.EventReport::latest()->first()->id.'/edit')->assertStatus(200);

    $data = [
        'id' => EventReport::latest()->first()->id,
        'title' => 'testreport',
        'content' => EventReport::latest()->first()->content,
        'day' => EventReport::latest()->first()->day,
        'level' => Level::factory()->create()->id,
    ];

    $datas = $this->put('admin/report/update', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'testreport',
    ]);
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
