<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Level;
use App\Models\EventReport;

it('filters scheduled day in event', function () {


  $this->withExceptionHandling();

  $event = Event::factory()->create();
  $level = Level::factory()->create();

  // dd($event->schedule[0]);

  $report1 = EventReport::factory()->times(2)->create([
    'event_id' => $event->id,
    'level_id' => $level->id,
    'title' => 'hugas plato',
    'date_added' => Carbon::parse(json_decode($event->schedule, true)[0]['date_start'])->addHours(2)
  ]);

 $report2 = EventReport::factory()->times(2)->create([
    'event_id' => $event->id,
    'level_id' => $level->id,
    'title' => 'boy tornado',
    'date_added' => Carbon::parse(json_decode($event->schedule, true)[1]['date_start'])->addHours(2)
  ]);


  $day1 = json_decode($event->schedule)[0]->day;
  $result1 = $this->get("api/lof-live-report?event=$event->slug&filterDay=$day1");

  $result1
    ->assertJsonPath(
        'data.0.collection.0.slug' , 'hugas-plato'
    );


  $day2 = json_decode($event->schedule)[1]->day;

  $result2 = $this->get("api/lof-live-report?event=$event->slug&filterDay=$day2");

 $result2
    ->assertJsonPath(
        'data.0.collection.0.slug' , 'boy-tornado'
    );



    // $json
    // ->assertJsonPath(
    //     'data.1.collection.0.slug' , 'first'
    // );


});