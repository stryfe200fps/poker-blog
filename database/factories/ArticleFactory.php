<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleAuthor;
use App\Models\ArticleCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->name,
            'content' => [
                [ 
                'title' => 'this title',
                'body' => 'this body'
                ]
            ],
            'slug' => $this->faker->slug,
            'published_date' => Carbon::now()->toString(),
            'article_author_id' => ArticleAuthor::factory()->create()->id,
        ];
    }
}
