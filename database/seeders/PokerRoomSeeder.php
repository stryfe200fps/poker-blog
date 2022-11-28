<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Tour;
use App\Services\ImageService;
use Illuminate\Database\Seeder;

class PokerRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = ['SkyCity Adelaide', 'Ginza Casino Paraja Tokyo'];
        foreach ($rooms as $room) {
            $roomFactory = Room::factory()->create(['title' => $room]);
            $link = config('app.url'). '/default_og-image.png';
            $imageService = new ImageService($link, $roomFactory);
            $imageService->imageUpload();
        }
    }
}
