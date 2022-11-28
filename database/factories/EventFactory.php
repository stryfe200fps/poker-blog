<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventGameTable;
use App\Models\Tournament;
use Carbon\Carbon;
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
            'tournament_id' => fn() => Tournament::factory()->create()->id,
            'buyin' => 200,
            'fee' => 200,
            'title' => $this->faker->name,
            'event_game_table_id'  => fn() =>EventGameTable::factory()->create()->id,
            'description' => $this->faker->text,
        ];
    }
}
