<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
<<<<<<< HEAD
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
=======
<<<<<<<< HEAD:database/factories/BadgeFactory.php
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
========
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Banner>
 */
class BannerFactory extends Factory
>>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32:database/factories/BannerFactory.php
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
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
            'name' => 'name',
            'location' => 'location',
            'url' => 'https://adi.com'
=======
            'title' => $this->faker->word
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
        ];
    }
}
