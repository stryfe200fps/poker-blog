<?php

use App\Models\Author;
use App\Models\Day;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\Level;
use App\Models\Player;
use App\Models\User;
use Carbon\Carbon;

test('whatsapp api', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $event = Event::factory()->create([
        'id' => 1,
        'slug' => 'final-event',
    ]);

    $day = Day::factory()->create();
    $page = $this->get('admin/report?event='.$event->id.'&day='. $day->id)->assertStatus(200);


    $eventChip = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 1,
        'event_id' => $event->id,
    ]);

    $eventChip2 = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 1,
        'event_id' => $event->id,
    ]);


    $response = $this->get('api/chip/day/'.$eventChip2->event_report->day_id.'/whatsapp');
    $response->assertStatus(200);

    // dd($response->json());

    //check if whatsapp is true
    $response->assertJsonPath(
        '0.is_whatsapp', 1
    );
});
