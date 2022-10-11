<?php

namespace Database\Factories;

use App\Models\ImageTheme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageThemeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImageTheme::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => $this->faker->word,
        ];
    }
}
