<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageResource;
use App\Models\Day;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
        public function gallery(int $id)
    {
        $day = Day::find($id);

        // dd($day->allMedia());

        $mediaArray = [];
        foreach ($day->getMedia('event_gallery') as $media) {
            $mediaArray[] = $media;
            // $imgResource[] = [
            //     'thumbnail' => $media->getUrl('main-gallery-thumb'),
            //     'main' => $media->getUrl('main-gallery'),
            // ];
        }

        foreach ($day->event_reports as $report) {
            if ($path = $report->getFirstMediaPath('event-report', 'xs-image')) { 
                if (File::exists($path)) { 
                    $mediaArray[] = $report->media[0];
                // $imgResource[] = [
                // 'thumbnail' => $report->getFirstMediaUrl('event-report', 'main-thumb2'),
                // 'main' => $report->getFirstMediaUrl('event-report', 'main-image')
                // ];
            }
            }
        }

       return ImageResource::collection($mediaArray);
        // return $imgResource;
    }
}
