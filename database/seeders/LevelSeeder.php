<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Level 1 100/500', 'Level 10 1000/2000', 'Level 20 2000/5000', 'Level 30 4000/5000', 'Level 50 3888/5888'] as $level) {
            Level::factory()->create(['name' => $level]);
        }
    }
}
