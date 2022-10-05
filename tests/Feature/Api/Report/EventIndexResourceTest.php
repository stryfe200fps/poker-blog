<?php

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Level;
use App\Models\EventReport;

it('works', function () {


  $this->withExceptionHandling();
  $event = Event::factory()->create();
  $level = Level::factory()->create([
    'event_id' => $event->id
  ]);

  $report1 = EventReport::factory()->times(1)->create([
    'event_id' => $event->id,
    'level_id' => $level->id,
    'title' => 'hugas plato',
    'date_added' => Carbon::parse($event->schedule[0]['date_start'])->addHours(2)->toDateString()

  ]);
  // dd($report1);
// 

 $callApi =  $this->get('api/lof-event');

 $callApi->assertStatus(200);

//  dd($callApi->json());

});

