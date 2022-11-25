<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Author;
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
        // $get = base64_encode(file_get_contents('https://www.fillmurray.com/640/360'));
        // dd(base64_encode($get));

        return [
            'title' => $this->faker->name,
            'content' => [
                [
                    'title' => $this->faker->paragraph(5),
                    'body' => $this->faker->paragraph(20),
                ],
                [
                    'title' => $this->faker->paragraph(5),
                    'body' => $this->faker->paragraph(20),
                ],
                [
                    'title' => $this->faker->paragraph(5),
                    'body' => $this->faker->paragraph(20),
                ],
            ],
            'slug' => $this->faker->slug,
            'published_date' => Carbon::now()->toString(),
            'author_id' => Author::factory()->create()->id,
            'description' => $this->faker->paragraph(3),
        ];
    }
}
