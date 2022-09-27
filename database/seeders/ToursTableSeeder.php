<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ToursTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tours')->delete();

        \DB::table('tours')->insert([
            0 => [
                'id' => 6,
                'title' => 'Asia Pacific Poker Tour',
                'image' => null,
                'description' => 'The Asia Pacific Poker Tour (APPT) is a major international series of poker tournaments established in 2007 and hosted in cities across the Asia Pacific. Along with other major tours such as the European Poker Tour and Latin American Poker Tour, the Asia Pacific Poker Tour is sponsored by PokerStars.',
                'content' => null,
                'created_at' => '2022-09-18 09:00:23',
                'updated_at' => '2022-09-18 09:00:23',
            ],
        ]);
    }
}
