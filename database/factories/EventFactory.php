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

    $sheduleFormat = 
    '[
        {"day":"1",
        "date_start":"2022-09-29 06:53:00",
        "date_end":"2022-09-29 17:53:00"
        },
        
        {"day":"2",
        "date_start":"2022-09-30 8:53:00",
        "date_end":"2022-09-30 14:53:00"
        }
    ]';



        return [
            'tournament_id' => Tournament::factory()->create()->id,
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'schedule' => json_decode($sheduleFormat, true),
            'date_start' => $this->faker->dateTime(),
            'date_end' => $this->faker->dateTime(),
        ];
    }
}
