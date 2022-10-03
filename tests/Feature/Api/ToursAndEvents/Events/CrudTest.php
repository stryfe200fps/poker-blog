<?php

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Article;
use App\Models\Tournament;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


it('cannot create events if unauthenticated', function () {
    $this->post('admin/events/', [
        'title' => 'adrian',
    ])->assertStatus(302);
});

it('can insert event if authenticated', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $this->get('admin/events/create')->assertStatus(200);

    $sheduleFormat = 
    '[
        {"day":"1",
        "date_start":"2022-09-29 06:53:00",
        "date_end":"2022-09-29 17:53:00"
        },
        
        {"day":"2",
        "date_start":"2022-09-30 8:53:00",
        "date_end":"2022-09-30 14:53:00"
        }
    ]';

    $data = [
        'title' => 'Things I do',
        'description' => 'description',
        'date_end' => '2021-02-02 00:00:00',
        'schedule' => json_decode($sheduleFormat, true),
        'date_start' => '2021-02-02 00:00:00',
        'tournament' => Tournament::factory()->create(),
        'tournament_id' => Tournament::factory()->create()->id,
    ];

    $this->post('/admin/events', $data);

    $this->assertDatabaseHas('events', ['title' => 'Things I do' ]);

});

it('can update event if authenticated', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();
    $event = Event::factory()->create();

    $this->get('admin/events/'. $event->id . '/edit')->assertStatus(200);

// dd($sheduleFormat);


    $day1DateStart = Carbon::now();

    $sheduleFormat = [
    [
        'day' => 1,
        'date_start' =>  $day1DateStart->toString(),
        'date_end' => $day1DateStart->addHours(12)->toString()
    ],
    [
        'day' => 2,
        'date_start' =>  $day1DateStart->addDay(1)->toString(),
        'date_end' => $day1DateStart->addHours(36)->toString()
    ]
    ];

    $data = [
        'id' => $event->id,
        'title' => 'Things I do',
        'schedule' => $sheduleFormat,
        'description' => 'description',
        'date_end' => '2021-02-02 00:00:00',
        'date_start' => '2021-02-02 00:00:00',
    ];

    $this->put('/admin/events/update', $data);

    $this->assertDatabaseHas('events', ['title' => 'Things I do',
    ]);
 
    $this->assertDatabaseCount('events', 1);

});

it('can delete events if authenticated', function () {

    superAdminAuthenticate();

    $event = Event::factory()->create();
    $this->get('admin/events')->assertStatus(200);
    $this->delete('admin/events/1');
});
