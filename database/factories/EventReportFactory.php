<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Day;
use App\Models\Event;
use App\Models\EventReport;
use App\Models\ImageTheme;
use App\Models\Level;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'content' => $this->faker->paragraph,
            'level_id' => Level::factory()->create()->id,
            'author_id' => Author::factory()->create()->id,
            'day_id' => Day::factory()->create()->id,
            'published_date' => Carbon::now(),
            'type' => 'report'
        ];

    }
}
