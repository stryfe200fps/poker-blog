<?php

use App\Models\Article;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Level;
use App\Models\Player;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('works', function () {
    $event = Event::factory()->create([
        'id' => 54,
    ]);

    // 'title' => $this->faker->title,
    // 'content' => $this->faker->paragraph,
    // 'day' => $this->faker->numberBetween(1, 3),
    // 'level_id' => Level::factory()->create()->id,
    // 'players' => $this->faker->name,
    // 'event_id' => $this->faker->numberBetween(1, 3),
    // 'article_author_id' => 1,
    // 'date_added' => $this->faker->date,
    // 'image_caption' => $this->faker->name,

    $playerId = Player::factory()->create([
        'id' => 33,
    ]);

    // $eventChip1 = );

    $report1 = EventReport::factory()->create([
        'id' => 20,
        'event_id' => 54,
        'players' => EventChip::factory()->create([
            'event_id' => 54,
            'player_id' => 33,
            'event_report_id' => 20,
            'current_chips' => 1000,
        ]),
        'day' => 1,
    ]);

    sleep(1);

    $report2 = EventReport::factory()->create([
        'id' => 25,
        'event_id' => 54,
        'players' => EventChip::factory()->create([
            'player_id' => 33,
            'event_id' => 54,
            'event_report_id' => 25,
            'current_chips' => 5000,
        ]),
        'day' => 1,
    ]);

    sleep(1);

    $report3 = EventReport::factory()->create([
        'id' => 30,
        'event_id' => 54,
        'players' => EventChip::factory()->create([
            'event_id' => 54,
            'player_id' => 33,
            'event_report_id' => 30,
            'current_chips' => 9000,
        ]),
        'day' => 1,
    ]);

    $json = $this->get('api/lof-live-report/'.'?event='.$report1->event_id.'&filterDay=1');

    $jsonDec = $json->decodeResponseJson()->json;

    $hings = collect(collect((json_decode($jsonDec, true)['data']))->pluck(['event_chips']))->sortByDesc('created_at');

    // $obj = [];
    // $mapped = $hings->map(function ($item) {
    //  return [
//     'id' => $item[0]['id'],
//     'current chip' =>  $item[0]['current_chips'],
//     'previous' => $item[0]['previous'],
//     'created_at' =>  $item[0]['created_at']
    //   ];
    // });

    // dd($mapped);

    // dd (collect(collect[0])->pluck('current_chips') ) ;

    // dump('current chips: ' . (json_decode($report1->players, true))[0]['current_chips'] ,   'previous chips : ' . (json_decode($report1->players, true))[0]['chips_before']) ;
    // dump('current chips: ' . (json_decode($report2->players, true))[0]['current_chips'],   'previous chips : ' . (json_decode($report2->players, true))[0]['chips_before']) ;
    // dump('current chips: ' . (json_decode($report3->players, true))[0]['current_chips'],   'previous chips : ' . (json_decode($report3->players, true))[0]['chips_before']) ;

    // dd();

    // , $report2->players, $report3->players);

    // dd($event);
});
