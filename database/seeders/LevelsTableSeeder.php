<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('levels')->delete();

        \DB::table('levels')->insert([
            0 => [
                'id' => 1,
                'name' => 'Level 1 100/500',
                'created_at' => '2022-09-18 07:21:45',
                'updated_at' => '2022-09-18 07:21:45',
            ],
            1 => [
                'id' => 2,
                'name' => 'Level 10 1000/2000',
                'created_at' => '2022-09-18 07:21:45',
                'updated_at' => '2022-09-18 07:21:45',
            ],
            2 => [
                'id' => 3,
                'name' => 'Level 20 2000/5000',
                'created_at' => '2022-09-18 07:21:45',
                'updated_at' => '2022-09-18 07:21:45',
            ],
            3 => [
                'id' => 4,
                'name' => 'Level 30 4000/5000',
                'created_at' => '2022-09-18 07:21:45',
                'updated_at' => '2022-09-18 07:21:45',
            ],
            4 => [
                'id' => 5,
                'name' => 'Level 50 3888/5888',
                'created_at' => '2022-09-18 07:21:45',
                'updated_at' => '2022-09-18 07:21:45',
            ],
            5 => [
                'id' => 6,
                'name' => 'Level: 18 4000/8000',
                'created_at' => '2022-09-18 09:21:04',
                'updated_at' => '2022-09-18 09:21:04',
            ],
            6 => [
                'id' => 7,
                'name' => 'Level: 1 100/200',
                'created_at' => '2022-09-18 09:33:17',
                'updated_at' => '2022-09-18 09:33:17',
            ],
            7 => [
                'id' => 8,
                'name' => 'Level: 3 200/400 400 ante',
                'created_at' => '2022-09-18 09:41:47',
                'updated_at' => '2022-09-18 09:41:47',
            ],
            8 => [
                'id' => 9,
                'name' => 'Level: 4 200/500 500 ante',
                'created_at' => '2022-09-18 09:54:04',
                'updated_at' => '2022-09-18 09:54:04',
            ],
            9 => [
                'id' => 10,
                'name' => 'Level 5 300/600 ante 600',
                'created_at' => '2022-09-18 09:55:05',
                'updated_at' => '2022-09-18 09:55:05',
            ],
            10 => [
                'id' => 11,
                'name' => 'Level: 6 400/800 ante 800',
                'created_at' => '2022-09-18 10:19:25',
                'updated_at' => '2022-09-18 10:19:25',
            ],
            11 => [
                'id' => 12,
                'name' => 'Level: 8 600/1200 1200 ante',
                'created_at' => '2022-09-18 10:22:05',
                'updated_at' => '2022-09-18 10:22:05',
            ],
            12 => [
                'id' => 13,
                'name' => 'Level: level 9 500/1000 ante 1000',
                'created_at' => '2022-09-18 10:23:30',
                'updated_at' => '2022-09-18 10:23:30',
            ],
        ]);
    }
}
