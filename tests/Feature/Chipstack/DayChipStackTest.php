<?php

use App\Models\Day;
use App\Models\Event;
use App\Models\Player;
use App\Models\ChipCount;
use App\Models\EventChip;
use Illuminate\Support\Facades\Schema;

test('it cannot inserts chip stack without authentication', function () {
    $this->post('admin/article/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

test('it can insert in event chips', function () {
    superAdminAuthenticate();

    $data = EventChip::factory()->make([
        'event_report_id' => null,
    ])->attributesToArray();

    $id = $data['day_id'];
    $event = Day::find($id)->first()->event_id;

    $this->get("admin/chip-count/create?day=$id&event=$event")->assertStatus(200);
    $this->post('admin/chip-count', $data);

    $this->assertDatabaseHas('event_chips', [
        'player_id' => $data['player_id'],
        'current_chips' => $data['current_chips']
    ]);
});

it('it validates when insert wrong data', function () {
    superAdminAuthenticate();

    $data = EventChip::factory()->make([
        'event_report_id' => null,
    ])->attributesToArray();

    $id = $data['day_id'];
    $event = Day::find($id)->first()->event_id;

    $this->get("admin/chip-count/create?day=$id&event=$event")->assertStatus(200);

   $postedEmpty =  $this->post('admin/chip-count', []);

    $postedEmpty->assertSessionHasErrors('player_id');
    $postedEmpty->assertSessionHasErrors('current_chips');
    $postedEmpty->assertSessionHasErrors('day_id');
});


