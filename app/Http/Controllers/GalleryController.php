<?php

namespace App\Http\Controllers;

use App\Http\Resources\CachedImageResource;
use App\Http\Resources\ImageResource;
use App\Models\Day;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
        public function gallery(int $id)
    {
        $day = Day::find($id);

        $mediaArray = [];
        foreach ($day->getMedia('event_gallery') as $media) {
            $mediaArray[] = $media;
        }

        foreach ($day->event_reports as $report) {

            if (is_string($report->mediaModel))
                continue;

            if ($path = $report->mediaModel->getPath()){ 

                if (File::exists($path)) { 
                    $mediaArray[] = $report->mediaModel;
            }
            }
        }

       return CachedImageResource::collection($mediaArray);
    }
}
