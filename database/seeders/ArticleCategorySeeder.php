<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Poker News', 'Poker Article', 'Poker Blog'];

        foreach ($categories as $category) {
            ArticleCategory::factory()->create(['title' => $category]);
        }
    }
}
