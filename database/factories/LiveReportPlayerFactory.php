<?php

namespace Database\Factories;

use App\Models\LiveReportPlayer;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiveReportPlayerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LiveReportPlayer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'current_chips' => $this->faker->numberBetween(-10000, 10000),
            'chips_before' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
