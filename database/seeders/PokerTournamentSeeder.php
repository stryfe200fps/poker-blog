<?php

namespace Database\Seeders;

use App\Models\Tournament;
use Illuminate\Database\Seeder;

class TournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $tournaments = ['2022 WSOP Online', '2022 RGPS Bay Area',
            '2022 MSPT United States Poker Championship', '2022 Winamax Poker Open Bratislava',
            '2022 Unibet Malta', ];

        foreach ($tournaments as $tournament) {
            Tournament::factory()->create(['title' => $tournament]);
        }
    }
}
