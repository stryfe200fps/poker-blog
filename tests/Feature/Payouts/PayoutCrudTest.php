<?php

use App\Models\Day;
use App\Models\Event;
use App\Models\Player;
use App\Models\ChipCount;
use App\Models\EventChip;
use App\Models\EventPayout;
use Illuminate\Support\Facades\Schema;

test('it cannot inserts payout without authentication', function () {
    $this->post('admin/payout/', [
        'prize' => 'adrian',
    ])->assertStatus(302);
});

test('it can insert in payouts', function () {
    superAdminAuthenticate();
    $data = EventPayout::factory()->make([
        'prize' => '202020'
    ])->attributesToArray();

    $eventId = $data['event_id'];
    $this->get("admin/payout/create?event=$eventId")->assertStatus(200);

    $this->post('admin/payout', $data);

    $this->assertDatabaseHas('event_payouts', [
        'prize' => '202020',
    ]);
});


test('it can update in payouts', function () {
    superAdminAuthenticate();

    $create = EventPayout::factory()->create([
        'prize' => '50000'
    ]);


    $data = EventPayout::factory()->make([
        'id' => $create->id,
        'prize' => '202020'
    ])->attributesToArray();


    $payoutId = $create->id;
    $this->get('admin/payout/'.$payoutId.'/edit')->assertStatus(200);

    $this->put('/admin/payout/update', $data);

    $this->assertDatabaseHas('event_payouts', [
        'prize' => $data['prize'],
    ]);

});
// it('it validates when insert wrong data', function () {
//     superAdminAuthenticate();

//     $player = Player::factory()->create();
//     $data = EventChip::factory()->make([
//         'event_report_id' => null,
//         'player' => $player->id
//     ])->attributesToArray();

//     $id = $data['day_id'];
//     $event = Day::find($id)->first()->event_id;

//     $this->get("admin/chip-count/create?day=$id&event=$event")->assertStatus(200);

//    $postedEmpty =  $this->post('admin/chip-count', []);
//     $postedEmpty->assertSessionHasErrors('current_chips');
//     $postedEmpty->assertSessionHasErrors('player');
// });



