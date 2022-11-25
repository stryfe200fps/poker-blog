<?php

namespace Database\Seeders;

use App\Models\EventChip;
use Illuminate\Database\Seeder;

class EventChipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventChip::factory()->count(5)->create();
    }
}
