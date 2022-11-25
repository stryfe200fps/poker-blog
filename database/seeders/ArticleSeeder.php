<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
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
        $articles = ['Xin Hua Lai wins the APPT Main Event for ₱5,973,000 ', 'Seina Asagiri leads last 21 players into final day of the APPT Main Event ',
            'Poker', 'APPT Main Event attracts a total of 801 entries ', 'James Mendoza wins the APPT Super High Roller ₱6,206,333 ',
            'Junya Kubo wins APPT National for ₱2,465,000! ',
        ];
        foreach ($articles as $article) {
            $createdArticle = Article::factory()->create(['title' => $article]);
            $createdArticle->article_categories()->attach(ArticleCategory::first());
        }
    }
}
