<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
<<<<<<<< HEAD:database/factories/BadgeFactory.php
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
========
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
>>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32:database/factories/BannerFactory.php
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word
        ];
    }
}
