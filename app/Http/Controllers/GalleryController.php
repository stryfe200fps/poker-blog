<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function gallery(int $id)
    {

        $day = Day::find($id);

        $imgResource = [];
        foreach ($day->getMedia('event_gallery') as $media) {
            $imgResource[] = [
                'thumbnail' => $media->getUrl('main-gallery-thumb'),
                'main' => $media->getUrl('main-gallery'),
            ];
        }

        return $imgResource;


    }
}
