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
<<<<<<< HEAD
            'type' => $this->faker->word,
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'link' => $this->faker->url,
            'published_date' =>now() 
=======
            //
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        ];
    }
}
