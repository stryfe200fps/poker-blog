<?php

use App\Http\Resources\EventResource;
use App\Models\Event;

test('it can see the event', function () {


    $event = Event::factory()->create([
        'title' => 'api adi test'
    ]);


    $response = $this->get('/api/events');

    $response->assertJsonPath(
        'data.0.title',
        $event->title

    );


    $response->assertJsonPath(
        'data.0.fee_usd',
        $event->fee_usd
    );

    $response->assertJsonPath(
        'data.0.buyin_usd',
        $event->buyin_usd
    );

    $response->assertStatus(200);
});
