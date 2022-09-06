<?php

namespace Database\Seeders;

use App\Models\PokerTournament;
use Illuminate\Database\Seeder;

class PokerTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PokerTournament::factory()->count(5)->create();
    }
}
