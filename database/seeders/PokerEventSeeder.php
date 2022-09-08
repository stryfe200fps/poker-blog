<?php

namespace Database\Seeders;

use App\Models\PokerEvent;
use Illuminate\Database\Seeder;

class PokerEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = ['#75 Online In Okada', '#76 Online in World Trade', '#200 Nice Trade Poker'];

        foreach ($schedules as $schedule) {
            PokerEvent::factory()->create(['title' => $schedule]);
        }
    }
}
