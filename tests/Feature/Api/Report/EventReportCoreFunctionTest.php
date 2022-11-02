<?php

use App\Models\Day;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Level;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('if the "stacks before" is updating on next report ', function () {
    $this->withoutExceptionHandling();

    $event = Event::factory()->create([
        'id' => 1
    ]);

    $day = Day::factory()->create([
        'id' => 1
    ]);

    $r1 = EventReport::factory()->create([
        'title' => 'first',
        'published_date' => Carbon::now(),
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 3,
        ])->id,
        'day_id' => $day->id 
    ]);

    $r1Chip = EventChip::factory()->create([
        'event_id' => $event->id,
        'event_report_id' => $r1->id
    ]);

    $r2 = EventReport::factory()->create([
        'title' => 'second',
        'published_date' => Carbon::now()->addHour(),
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 3,
        ])->id,
        'day_id' => $day->id 
    ]);

    $r2Chip = EventChip::factory()->create([
        'event_id' => $event->id,
        'event_report_id' => $r2->id
    ]);

    $r3 = EventReport::factory()->create([
        'title' => 'third',
        'published_date' => Carbon::now()->addHours(2),
        'level_id' => Level::factory()->create([
            'event_id' => $event->id,
            'level' => 3,
        ])->id,
        'day_id' => $day->id 
    ]);

    $r3Chip = EventChip::factory()->create([
        'event_id' => $event->id,
        'event_report_id' => $r3->id
    ]);

    $json = $this->get('api/lof-live-report'.'?day='.$day->id.'');

    $json
    ->assertJsonPath(
        'data.0.collection.0.title', 'third'
    );

    $json
    ->assertJsonPath(
        'data.2.collection.0.title', 'first'
    );
});
