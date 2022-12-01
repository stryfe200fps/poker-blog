<?php

use App\Models\EventPayout;
use Illuminate\Http\UploadedFile;
use App\Services\SpreadsheetService;




test('it can prepare something in spreadsheet', function () {

    $file = new UploadedFile(public_path('payout.xlsx'), 'payout.xlsx');
    $eventPayout = EventPayout::factory()->create();
    $spreadsheet = new SpreadsheetService($file, $eventPayout);

    expect(count($spreadsheet->getHeader()))->toBeGreaterThan(0);
    expect(count($spreadsheet->getSpreadsheetHeader()))->toBeGreaterThan(0);
});

test('it uploads a spreadsheet and save something', function () {


    $file = new UploadedFile(public_path('payout.xlsx'), 'payout.xlsx');
    $eventPayout = EventPayout::factory()->create();
    $spreadsheet = new SpreadsheetService($file, $eventPayout);

    $chosen = [
        [
            'prize' => '0'
        ],
        [
            'player_id' => null
        ]
    ];
    dd($spreadsheet->upload($chosen));
});
