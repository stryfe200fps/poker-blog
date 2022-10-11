<?php

namespace Database\Factories;

use App\Models\ArticleAuthor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleAuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ArticleAuthor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'avatar' => $this->faker->word, ];
    }
}
