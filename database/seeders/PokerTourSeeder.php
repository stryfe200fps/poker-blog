<?php

namespace Database\Seeders;

use App\Models\PokerTour;
use Illuminate\Database\Seeder;

class PokerTourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tours = ['World Series of poker', 'World Poker Tour', 'European Poker Tour', '888poker LIVE', 'partypoker LIVE'];
        foreach ($tours as $tour) {
            PokerTour::factory()->create(['title' => $tour]);
        }
    }
}
