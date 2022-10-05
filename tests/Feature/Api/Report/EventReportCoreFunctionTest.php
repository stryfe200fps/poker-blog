<?php

use App\Models\Article;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Level;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('if the "stacks before" is updating on next report ', function () {
    $this->withoutExceptionHandling();
    $event = Event::factory()->create();


    $playerId = Player::factory()->create([
        'id' => 33,
    ]);

    $chip =  EventChip::factory()->create([
            'player_id' => 33,
            'current_chips' => 1000,
    ]);


    $report1 = EventReport::factory()->create([
        'event_id' => $event->id,
        'title' => 'first',
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' =>  3 
        ])->id,
        'players' => $chip,
        'day' => 1,
    ]);


    // dd($report1);

    $chip1 = EventChip::factory()->create([
            'player_id' => 33,
            'current_chips' => 5000,
    ]);

    $report2 = EventReport::factory()->create([

        'id' => 25,
        'event_id' => $event->id,
        'title' => 'second',
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 1 
        ])->id,
        'players' => $chip1,
        'day' => 1,
    ]);

$chip2 = EventChip::factory()->create([
            'player_id' => 33,
            'current_chips' => 5000,
    ]);

    $report3 = EventReport::factory()->create([

        'id' => 30,
        'event_id' => $event->id,
        'title' => 'third',
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 5 
            ])->id,
        'players' => $chip2,
        'day' => 1,
    ]);

    $json = $this->get('api/lof-live-report'.'?event='.$event->slug.'&filterDay=1');

    $json
    ->assertJsonPath(
        'data.0.collection.0.slug' , 'third'
    );

    $json
    ->assertJsonPath(
        'data.1.collection.0.slug' , 'first'
    );
});
