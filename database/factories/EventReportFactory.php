<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventReport;
use App\Models\ImageTheme;
use App\Models\Level;
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
        // $levels = ['Level 9 200/500', 'level 14 2000/5000', 'level 30 5000/7000', 'Level 40 6000/8000'];

        return [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
            'day' => $this->faker->numberBetween(1, 3),
            'level_id' => Level::factory()->create(['event_id' => Event::factory()->create()->id])->id,
            'players' => '[{"name":"","event_report_id":7,"event_id":"6","player_id":"2","current_chips":"7000","updated_at":"2022-09-23T19:05:33.000000Z","created_at":"2022-09-23T19:05:33.000000Z","id":55}]',
            'event_id' => Event::factory()->create()->id,
            'article_author_id' => 1,
            'image_theme_id' => ImageTheme::factory()->create(function ($image) {
            })->id,
            'date_added' => $this->faker->date,
            'image_caption' => $this->faker->name,
        ];
    }
}
