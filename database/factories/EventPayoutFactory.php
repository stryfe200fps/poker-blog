<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payout>
 */
class EventPayoutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'player_id' => Player::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,
            'prize' => '20000',
            'position' => 1
        ];
    }
}
