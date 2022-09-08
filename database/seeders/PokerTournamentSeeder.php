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
        // PokerTournament::factory()->count(5)->create();
        $tournaments = ['2020 Poker Tournament', '2020 Online Poker Tournament', 'Tours 2021'];

        foreach ($tournaments as $tournament) {
            PokerTournament::factory()->create(['title' => $tournament]);
        }
    }
}
