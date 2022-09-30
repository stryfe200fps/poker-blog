<?php

use App\Models\Article;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Level;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('if ', function () {
    $event = Event::factory()->create();


    $playerId = Player::factory()->create([
        'id' => 33,
    ]);

    $report1 = EventReport::factory()->create([
        'event_id' => $event->id,
        'title' => 'first',
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' =>  3 
        ])->id,
        'players' => EventChip::factory()->create([
        'event_id' => $event->id,
            'player_id' => 33,
            'event_report_id' => 20,
            'current_chips' => 1000,
        ]),
        'day' => 1,
    ]);

    $report2 = EventReport::factory()->create([
        'event_id' => $event->id,
        'title' => 'second',
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 1 
        ])->id,
        'players' => EventChip::factory()->create([
            'player_id' => 33,
        'event_id' => $event->id,
            'event_report_id' => 25,
            'current_chips' => 5000,
        ]),
        'day' => 1,
    ]);


    $report3 = EventReport::factory()->create([
        'event_id' => $event->id,
        'title' => 'third',
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 5 
            ])->id,
        'players' => EventChip::factory()->create([
           
            'event_id' => $event->id,
            'player_id' => 33,
            'event_report_id' => 30,
            'current_chips' => 9000,
        ]),
        'day' => 1,
    ]);

    $json = $this->get('api/lof-live-report/'.'?event='.$report1->event_id.'&filterDay=1');

    $json
    ->assertJsonPath(
        'data.0.collection.0.slug' , 'third'
    );

    $json
    ->assertJsonPath(
        'data.1.collection.0.slug' , 'first'
    );
});
