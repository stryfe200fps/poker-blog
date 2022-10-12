<?php

namespace Database\Factories;

use App\Models\Event;
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
        $day1DateStart = Carbon::now();

        $sheduleFormat = [
            [
                'day' => '1B',
                'date_start' => $day1DateStart->toString(),
                'date_end' => $day1DateStart->addHours(12)->toString(),
            ],
            [
                'day' => '2C',
                'date_start' => $day1DateStart->addDay(1)->toString(),
                'date_end' => $day1DateStart->addHours(36)->toString(),
            ],
        ];

        return [
            'tournament_id' => Tournament::factory()->create()->id,
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'schedule' => $sheduleFormat,
        ];
    }
}
