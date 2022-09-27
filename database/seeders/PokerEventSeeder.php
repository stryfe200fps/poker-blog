<?php

namespace Database\Seeders;

use App\Models\Event;
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
        $schedules = ['Event #5: $500 NLH Turbo Deepstack', 'Event #4: $1,000 PLO 6-Max',
            'Event #3: $3,200 NLH High Roller', 'Event #2: $500 NLH Monster Stack', 'Event #1: $400 NLH Kick-Off', ];

        foreach ($schedules as $schedule) {
            Event::factory()->create(['title' => $schedule]);
        }
    }
}
