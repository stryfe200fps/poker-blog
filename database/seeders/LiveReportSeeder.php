<?php

namespace Database\Seeders;

use App\Models\LiveReport;
use Illuminate\Database\Seeder;

class LiveReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LiveReport::factory()->count(5)->create();
    }
}
