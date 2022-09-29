<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tournament_id' => Tournament::factory()->create()->id,
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
        ];
    }
}
