<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tournaments')->delete();

        \DB::table('tournaments')->insert([
            0 => [
                'id' => 6,
                'title' => 'APPT Manila 13',
                'description' => 'Festival Dates: July 29-August 7, 2022',
                'image' => null,
                'country_id' => '608',
                'timezone' => 'Asia/Manila',
                'date_start' => '2022-07-29 12:04:00',
                'date_end' => '2022-08-07 22:04:00',
                'tour_id' => 6,
                'currency_id' => 83,
                'created_at' => '2022-09-18 09:07:54',
                'updated_at' => '2022-09-18 09:07:54',
            ],
        ]);
    }
}
