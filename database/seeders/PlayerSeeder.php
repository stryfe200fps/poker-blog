<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = ['Justin Bonomo', 'Bryn kenney', 'Daniel Negreanu', 'Stephen Chidwick', 'Erik Seidel', 'David Peters', 'Dan Smith'];
        foreach ($players as $name) {
            Player::factory()->create([
                'name' => $name,
            ]);
        }
    }
}
