<?php

use App\Models\Event;
use App\Models\EventReport;
use App\Models\Level;
use Carbon\Carbon;

it('filters scheduled day in event', function () {
    $this->withExceptionHandling();

    $event = Event::factory()->create();
    $level = Level::factory()->create();

    

    $report1 = EventReport::factory()->times(2)->create([
        'level_id' => $level->id,
        'title' => 'hugas plato',
    ]);


    $report2 = EventReport::factory()->times(2)->create([
        'level_id' => $level->id,
        'title' => 'boy tornado',
        // 'day' => 33,
    ]);

    $day1 = $report1[0]->day_id;
    // dd($day1, $report1, EventReport::all()->pluck('title'));
    $result1 = $this->get("api/report?day=$day1");

    $result1
      ->assertJsonPath(
          'data.0.collection.0.title', 'hugas plato'
      );


    $day2 = $report2[0]->day_id;

    $result2 = $this->get("api/report?day=$day2");


    $result2
       ->assertJsonPath(
           'data.0.collection.0.title', 'boy tornado'
       );

});
