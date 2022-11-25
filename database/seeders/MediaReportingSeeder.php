<?php

namespace Database\Seeders;

use App\Models\MediaReporting;
use Database\Factories\MediaReportingFactory;
use Illuminate\Database\Seeder;

class MediaReportingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      MediaReporting::factory()->times(3)->create();
    }
}
