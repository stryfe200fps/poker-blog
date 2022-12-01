<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MediaReporting>
 */
class MediaReportingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'show_homepage' => false,
            'type' => $this->faker->word,
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph(2),
            'link' => $this->faker->url,
            'published_date' => now()
        ];
    }
}
