<?php

namespace Database\Factories;

use App\Models\PokerEvent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokerEventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PokerEvent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'poker_tournament_id' => $this->faker->numberBetween(-100000, 100000),
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
        ];
    }
}
