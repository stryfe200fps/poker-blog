<?php

namespace Database\Seeders;

use App\Models\MediaReportingCategory;
use Illuminate\Database\Seeder;

class MediaReportingCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      MediaReportingCategory::factory()->times(3)->create();
    }
}
