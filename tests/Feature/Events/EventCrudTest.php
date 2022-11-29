<?php

use App\Models\Event;
use App\Models\EventGameTable;
use App\Models\Tournament;
use Carbon\Carbon;




it('cannot create events if unauthenticated', function () {
    $this->post('admin/events/', [
        'title' => 'adrian',
    ])->assertStatus(302);
});

it('can insert event if authenticated', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $this->get('admin/events/create')->assertStatus(200);

    $eventCreate = Event::factory()->make([
        'title' => 'Things I do',
        'event_game_table' => EventGameTable::factory()->create()
    ]);

$ter =  $this->post('/admin/events', $eventCreate->attributesToArray());
$this->assertDatabaseHas('events', ['title' => 'Things I do']);
});

it('can update event if authenticated', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();
    $event = Event::factory()->create();

    $this->get('admin/events/'.$event->id.'/edit')->assertStatus(200);

    $day1DateStart = Carbon::now();

    $eventUpdate = Event::factory()->make([
        'id' => $event->id,
        'title' => 'Things I do',
        'event_game_table' => EventGameTable::factory()->create()
    ]);

    $this->put('/admin/events/update', $eventUpdate->attributesToArray());

    $this->assertDatabaseHas('events', ['title' => 'Things I do',
    ]);

    $this->assertDatabaseCount('events', 1);
});

it('can delete events if authenticated', function () {

    $this->withoutExceptionHandling();

    superAdminAuthenticate();

    $event = Event::factory()->create();
    $this->delete('admin/events/'.$event->id);

    expect(Event::all()->count())->toBe(0);
});

it('it validates when insert wrong data', function () {
    superAdminAuthenticate();

    $this->get('admin/events/create')->assertStatus(200);
    $postedEmpty = $this->post('/admin/events', []);

    $postedEmpty->assertSessionHasErrors('title');
    $postedEmpty->assertSessionHasErrors('description');
    $postedEmpty->assertSessionHasErrors('event_game_table');
});
