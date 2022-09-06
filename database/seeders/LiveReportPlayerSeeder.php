<?php

namespace Database\Seeders;

use App\Models\LiveReportPlayer;
use Illuminate\Database\Seeder;

class LiveReportPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiveReportPlayer::factory()->count(5)->create();
    }
}
