<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ArticleCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'name' => 'Adi',
            'email' => 'admin@chanzglobal.com',
            'password' => bcrypt('admin')
        ]);

        $this->call([
            ArticleCategorySeeder::class,
            PokerTourSeeder::class,
            ArticleSeeder::class
        ]);

       
    }
}
