<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('events')->delete();

        \DB::table('events')->insert([
            0 => [
                'id' => 6,
                'tournament_id' => 6,
                'title' => 'APPT Kickoff NLH – ₱3,000,000 Guarantee',
                'description' => 'APPT Kickoff NLH – ₱3,000,000 Guarantee',
                'image' => null,
                'date_start' => '2022-07-29 08:09:00',
                'date_end' => '2022-07-31 00:09:00',
                'created_at' => '2022-09-18 09:15:27',
                'updated_at' => '2022-09-18 09:15:47',
            ],
        ]);
    }
}
