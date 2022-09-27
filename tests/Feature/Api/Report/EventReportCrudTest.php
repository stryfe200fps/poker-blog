<?php

use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Player;
use App\Models\Article;
use App\Models\EventChip;
use App\Models\Tournament;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use App\Models\EventReport;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// test('reports is working', function () {
//     $response = $this->get('/api/report');
//     $response->assertStatus(200);
// });

it('cannot create reports if unauthenticated', function () {
    $this->post('admin/report/', [
        'title' => 'adrian',
    ])->assertStatus(302);
});


it('cannot enter the site if there is no event session', function () {

    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);
    $u->assignRole($role);

    $user = $this->actingAs($u);

    $this->get('admin/report/create')->assertStatus(403);
});


it('can enter the site if there is event session', function () {

    $u = User::factory()->create();
    $role = Role::create([
        'name' => 'super-admin',
    ]);
    $u->assignRole($role);
    $user = $this->actingAs($u);

    $event = Event::factory()->create();


    $page = $this->get('admin/report?event=' . $event->id);

    $page->assertStatus(200);
    $page->assertSee($event->title);


});



it('can insert reports if authenticated', function () {
    $this->withoutExceptionHandling();
    $u = User::factory()->create();

    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $u->assignRole($role);

    $user = $this->actingAs($u);

     $event = Event::factory()->create();


   $page =  $this->get('admin/report/create?event='. $event->id)->assertStatus(200);


    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added'=> '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id
    ];
    

    $datas = $this->post('/admin/report', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);

});




it('can insert reports with event chips players', function () {
    $this->withoutExceptionHandling();
    $u = User::factory()->create();

    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $u->assignRole($role);

    $user = $this->actingAs($u);

     $event = Event::factory()->create();


   $page =  $this->get('admin/report/create?event='. $event->id)->assertStatus(200);

   $playerId = Player::factory()->create();
  $eventChip = EventChip::factory()->create([
    'player_id' => $playerId->id
  ]);

    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added'=> '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
        'players' => $eventChip->get()->toArray()
    ];

    $datas = $this->post('/admin/report', $data);


    $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);

});

it('can update reports if authenticated', function () {


        $this->withoutExceptionHandling();
    $u = User::factory()->create();

    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $u->assignRole($role);

    $user = $this->actingAs($u);

        $playerId = Player::factory()->create();
  $eventChip = EventChip::factory()->create([
    'player_id' => $playerId->id
  ]);

      $event = Event::factory()->create();
     $page =  $this->get('admin/report/create?event='. $event->id)->assertStatus(200);


    $data = [
        'title' => 'A report',
        'content' => 'this a content',
        'day' => '1A',
        'level_id' => Level::factory()->create()->id,
        'level' => Level::factory()->create(),
        'event_id' => $event->id,
        'poker_event_id' => Event::factory()->create()->id,
        'date_added'=> '2021-02-02 00:00:00',
        'user_id' => User::factory()->create()->id,
        'article_author_id' => ArticleAuthor::factory()->create()->id,
        'players' => $eventChip->get()->toArray()
    ];

    $datas = $this->post('/admin/report', $data);

     $this->assertDatabaseHas('event_reports', ['title' => 'A report',
    ]);

    $this->get('admin/report/'. EventReport::latest()->first()->id . '/edit')->assertStatus(200);

    $data = [
        'id' => EventReport::latest()->first()->id,
        'title' => 'testreport',
        'content' =>  EventReport::latest()->first()->content,
        'day' =>  EventReport::latest()->first()->day,
        'level' => Level::factory()->create()->id 
       
    ];

    $datas = $this->put('admin/report/update', $data);

    $this->assertDatabaseHas('event_reports', ['title' => 'testreport',
        ] );

})->skip();

it('can delete report if authenticated', function () {


            $this->withoutExceptionHandling();
    $u = User::factory()->create();

    $role = Role::create([
        'name' => 'super-admin',
    ]);

    $u->assignRole($role);

    $user = $this->actingAs($u);

    //end auth

    $article = EventReport::factory()->create();
    expect(EventReport::all()->count())->toBe(1);
    $this->get('admin/report')->assertStatus(200);
    $datas = $this->delete('admin/report/'. $article->id);
    expect(EventReport::all()->count())->toBe(0);


});