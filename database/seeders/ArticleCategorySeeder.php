<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;

class ArticleCategorySeeder extends Seeder
{
    public function run()
    {
        ArticleCategory::truncate();
        $categories = ['News', 'Events', 'Blog'];

        foreach ($categories as $category) {
            ArticleCategory::factory()->create(['title' => $category]);
        }
    }
}
