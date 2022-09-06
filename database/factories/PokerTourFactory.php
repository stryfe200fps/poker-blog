<?php

namespace Database\Factories;

use App\Models\PokerTour;
use Illuminate\Database\Eloquent\Factories\Factory;

class PokerTourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PokerTour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
