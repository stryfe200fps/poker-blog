<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventChipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventChip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $player = Player::factory()->create();
        return [
            'player_id' => $player->id,
            'player' => $player->id,
            'event_report_id' => EventReport::factory()->create()->id,
            'current_chips' => 2000,
            'day_id' => Day::factory()->create()->id,
            'published_date' => Carbon::now()
        ];
    }
}
