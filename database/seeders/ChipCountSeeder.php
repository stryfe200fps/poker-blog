<?php

namespace Database\Seeders;

use App\Models\ChipCount;
use Illuminate\Database\Seeder;

class ChipCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ChipCount::factory()->count(5)->create();
    }
}
