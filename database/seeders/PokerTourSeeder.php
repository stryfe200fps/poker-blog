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
        PokerTour::factory()->count(5)->create();
    }
}
