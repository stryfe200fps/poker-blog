<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = ['Poke article sample', 'This is a poker', 'Poker', 'Article', 'Factort Poker'];
        foreach ($articles as $article) {
            Article::factory()->create(['title' => $article, 'article_category_id' => rand(1, 3)]);
        }
    }
}
