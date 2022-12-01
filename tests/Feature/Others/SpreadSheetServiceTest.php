<?php

use App\Models\Day;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventPayout;
use Illuminate\Http\UploadedFile;
use App\Services\SpreadsheetService;
use Rap2hpoutre\FastExcel\FastExcel;

use function PHPUnit\Framework\assertContains;
use function PHPUnit\Framework\assertTrue;

test('it can prepare something in spreadsheet', function () {

    $file = new UploadedFile(public_path('payout.xlsx'), 'payout.xlsx');
    $eventPayout = EventPayout::factory()->create();
    $spreadsheet = new SpreadsheetService($file, $eventPayout);

    expect(count($spreadsheet->getHeader()))->toBeGreaterThan(0);
    expect(count($spreadsheet->getSpreadsheetHeader()))->toBeGreaterThan(0);
});

test('it uploads a spreadsheet and save something in payouts', function () {

    //payouts

    $event = Event::factory()->create();
    $file = new UploadedFile(public_path('payout.xlsx'), 'payout.xlsx');
    $spreader = (new FastExcel)->import($file);
    $eventPayout = EventPayout::factory()->create();
    $spreadsheet = new SpreadsheetService($file, $eventPayout);

    $chosen = [
        [
            'prize' => 'prize'
        ],
        [
            'player_id' => 'position'
        ]
    ];

    $prizes = $spreader->pluck('prize');

    $values = array_values($prizes->toArray());

    $spreadsheet->upload($chosen, ['event_id' => $event->id]);

    foreach (EventPayout::all() as $payout) {

        if (in_array($payout->prize, $values)) {
            assertTrue(in_array($payout->prize, $values));
        }
    }
});



test('it uploads a spreadsheet and save something in chip counts', function () {

    $day = Day::factory()->create();
    $file = new UploadedFile(public_path('payout.xlsx'), 'payout.xlsx');
    $spreader = (new FastExcel)->import($file);
    $eventPayout = EventChip::factory()->create();
    $spreadsheet = new SpreadsheetService($file, $eventPayout);

    $chosen = [
        [
            'current_chips' => 'prize'
        ],
        [
            'player_id' => 'position'
        ]
    ];

    $prizes = $spreader->pluck('prize');

    $values = array_values($prizes->toArray());

    $spreadsheet->upload($chosen, ['day_id' => $day->id]);

    foreach (EventChip::all() as $chip) {
        if (in_array($chip->current_chips, $values)) {
            assertTrue(in_array($chip->current_chips, $values));
        }
    }
});
