<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticleAuthorsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('article_authors')->delete();

        \DB::table('article_authors')->insert([
            0 => [
                'id' => 6,
                'first_name' => 'Cyril',
                'last_name' => 'Florendo',
                'avatar' => null,
                'description' => null,
                'user_id' => null,
                'created_at' => '2022-09-18 08:11:01',
                'updated_at' => '2022-09-18 08:11:01',
            ],
        ]);
    }
}
