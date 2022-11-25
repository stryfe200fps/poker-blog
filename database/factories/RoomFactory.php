<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'content' => $this->faker->paragraph(20),
            'country_id' => Country::factory()->create()->id,
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'website' => $this->faker->title,
        ];
    }
}
