<?php

use Illuminate\Support\Facades\Schema;

use Carbon\Carbon;
use App\Models\Day;
use App\Models\User;
use App\Models\Event;
use App\Models\Level;
use App\Models\Author;
use App\Models\Player;
use App\Models\EventChip;
use App\Models\Tournament;
use App\Models\EventGameTable;
use App\Models\Page;

test('whatsapp api', function () {
    $this->withExceptionHandling();
    superAdminAuthenticate();

    $eventChip = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 0,
    ]);

    $testChip = EventChip::factory()->create([
        'player_id' => Player::factory()->create()->id,
        'is_whatsapp' => 1,
        'day_id' => $eventChip->day_id
    ]);

    $response = $this->get('api/chip/day/'.$eventChip->day_id.'/whatsapp');

    $response->assertStatus(200);
    $response->assertJsonPath(
        'data.0.is_whatsapp', 1
    );

    // );
});
