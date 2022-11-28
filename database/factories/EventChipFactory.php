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
        return [
            'player_id' => fn() => Player::factory()->create()->id,
            'event_report_id' => fn() => EventReport::factory()->create()->id,
            'current_chips' => $this->faker->numberBetween(100, 1000000),
            'day_id' => fn() => Day::factory()->create()->id,
            'published_date' => $this->faker->dateTimeBetween(now(), '2 days'),
        ];
    }
}
