<?php

namespace Database\Factories;

use Carbon\Carbon;
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


        $day1DateStart = Carbon::now();
        $day1DateEnd = $day1DateStart->addHours(12);

        $day2DateStart = $day1DateEnd->addDay(1);
        $day2DateEnd = $day2DateStart->addHours(12);

        // dd($day1DateStart->toString());


    $sheduleFormat = 
    '[
        {"day":"1",
        "date_start":'. $day1DateStart->toString() .',
        "date_end":'. $day1DateEnd->toString() .'
        },
        
        {"day":"2",
        "date_start":'. $day2DateStart->toString() .',
        "date_end":'. $day2DateEnd->toString() .'
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
