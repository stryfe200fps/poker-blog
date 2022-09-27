<?php

namespace Database\Seeders;

use App\Models\ImageTheme;
use Illuminate\Database\Seeder;

class ImageThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImageTheme::factory()->count(5)->create();
    }
}
