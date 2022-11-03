<?php

use App\Models\Event;
use App\Models\EventGameTable;
use App\Models\Room;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('cannot create rooms if unauthenticated', function () {
    $this->post('admin/room/', [
        'name' => 'adrian',
    ])->assertStatus(302);
});

it('can insert rooms if authenticated', function () {
    superAdminAuthenticate();

    $this->get('admin/room/create')->assertStatus(200);

    $data = Room::factory()->make([
        'title' => 'Things I do',
    ])->attributesToArray();

    $datas = $this->post('admin/room', $data);
    $this->assertDatabaseHas('rooms', ['title' => 'Things I do',
    ]);
});

it('can update room if authenticated', function () {
    superAdminAuthenticate();

    $room = Room::factory()->create();

    $this->get('admin/room/'.$room->id.'/edit')->assertStatus(200);

    $data = Room::factory()->make([
        'id' => $room->id,
        'title' => 'things I hate',
    ])->attributesToArray();

    $this->put('admin/room/update', $data);
    $this->assertDatabaseHas('rooms', ['title' => 'things I hate']);
    $this->assertDatabaseCount('rooms', 1);
});


it('can delete article if authenticated', function () {
    superAdminAuthenticate();
    $room = Room::factory()->create();
    $this->get('admin/room')->assertStatus(200);
    $datas = $this->delete('admin/room/1');
    expect(Room::all()->count())->toBe(0);
});




