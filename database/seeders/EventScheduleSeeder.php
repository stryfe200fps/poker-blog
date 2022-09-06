<?php

namespace Database\Seeders;

use App\Models\EventSchedule;
use Illuminate\Database\Seeder;

class EventScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventSchedule::factory()->count(5)->create();
    }
}
