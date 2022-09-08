<?php

namespace Database\Factories;

use App\Models\PokerTournament;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokerTournamentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PokerTournament::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
            'poker_tour_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
