<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Services\ImageService;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tours = ['World Series of poker', 'World Poker Tour'];
        foreach ($tours as $tour) {
            $tourFactory = Tour::factory()->create(['title' => $tour]);
            $link = config('app.url'). '/default_og-image.png';
            $imageService = new ImageService($link, $tourFactory);
            $imageService->imageUpload();
        }
    }
}
