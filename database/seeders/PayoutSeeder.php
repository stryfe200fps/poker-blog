<?php

namespace Database\Seeders;

use App\Models\EventPayout;
use Illuminate\Database\Seeder;

class PayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventPayout::factory()->count(5)->create();
    }
}
