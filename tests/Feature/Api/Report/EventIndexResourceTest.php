<?php

use App\Models\Event;
use App\Models\EventReport;
use App\Models\Level;
use Carbon\Carbon;
use function Spatie\PestPluginTestTime\testTime;

it('works', function () {
    $this->withExceptionHandling();
    $event = Event::factory()->create();
    $level = Level::factory()->create([
        'event_id' => $event->id,
    ]);

    $report1 = EventReport::factory()->times(1)->create([
        'event_id' => $event->id,
        'level_id' => $level->id,
        'title' => 'hugas plato',
        'date_added' => Carbon::parse($event->schedule[0]['date_start'])->addHours(2)->toDateString(),

    ]);
    // dd($report1);
//

    $callApi = $this->get('api/lof-event');

    $callApi->assertStatus(200);

    //  dd($callApi->json());
});

it('available days is showing', function () {
    $this->withExceptionHandling();
    $event = Event::factory()->create();
    $level = Level::factory()->create([
        'event_id' => $event->id,
    ]);

    testTime()->freeze($event->schedule[0]['date_start']);

    $report1 = EventReport::factory()->times(1)->create([
        'event_id' => $event->id,
        'level_id' => $level->id,
        'title' => 'hugas plato',
        'date_added' => Carbon::parse($event->schedule[0]['date_start'])->addHours(2)->toDateString(),

    ]);

    $callApi = $this->get('api/lof-event');

    $callApi->assertStatus(200);

    $callJson = $this->json('GET', 'api/lof-event');

    $callJson->assertJsonFragment([
        'available_days' => [
            0 => '1B',
        ],
    ]);

    //  testTime()->freeze(); // the current time will not change anymore

    // $contact = $this->json('POST', 'api/contact', [
    //   'email' => 'kamlonboy@yhoo.com',
    //   'name' => 'Adrian',
    //   'message' => 'Adi radn',
    //   'subject' => 'Subject'
    // ])->assertJsonFragment([
    //   'status' => 200
    // ]);
});
