<?php

namespace Database\Seeders;

use App\Models\ArticleAuthor;
use Illuminate\Database\Seeder;

class ArticleAuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArticleAuthor::factory()->count(5)->create();
    }
}
