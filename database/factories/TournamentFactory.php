<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Tour;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TournamentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tournament::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $dateStart = Carbon::now();
        $dateEnd = Carbon::now()->addDays(30);


        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text,
            'date_start' => $dateStart,
            'date_end' => $dateEnd,
            'timezone' => '(GMT+8:00) Asia/Manila',
            'country_id' => Country::first()->id ?? 0,
            'tour_id' => Tour::factory()->create()->id,
            'currency_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
