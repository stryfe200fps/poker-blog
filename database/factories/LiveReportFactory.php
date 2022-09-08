<?php

namespace Database\Factories;

use App\Models\LiveReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiveReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LiveReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
            'day' => $this->faker->numberBetween(1, 3),
            'players' => $this->faker->name,
            'poker_event_id' => $this->faker->numberBetween(1, 3),
            'date_added' => $this->faker->date,
            'image_caption' => $this->faker->name,
        ];
    }
}
