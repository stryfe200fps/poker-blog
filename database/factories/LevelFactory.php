<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'level' => $this->faker->numberBetween(1, 5),
            'small_blinds' => $this->faker->numberBetween(500, 1000),
            'big_blinds' => $this->faker->numberBetween(500, 1000),
            'ante' => $this->faker->numberBetween(2000, 5000),
            'event_id' => fn() => Event::factory()->create()->id,
        ];
    }
}
