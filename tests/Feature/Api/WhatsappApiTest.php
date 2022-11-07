<?php

use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
use App\Models\Day;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Author;
use App\Models\Player;
use App\Models\EventChip;
use App\Models\Tournament;
use App\Models\EventGameTable;
use App\Models\Page;

test('whatsapp api', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $event = Event::factory()->create([

        'id' => 1,
        'slug' => 'final-event',
    ]);


    $day = Day::factory()->create([
        'event_id' => $event->id
    ]);

    $page = $this->get('admin/report?event='.$event->id.'&day='. $day->id)->assertStatus(200);



    $eventChip = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 0,
    ]);


    $eventChip2 = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 1,
    ]);

    $response = $this->get('api/chip/day/'.$eventChip2->event_report->day_id.'/whatsapp');
    $response->assertStatus(200);

    // dd($response->json());

    //check if whatsapp is true
    $response->assertJsonPath(
        '0.is_whatsapp', 1
    );
});
