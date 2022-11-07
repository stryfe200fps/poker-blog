<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Support\Facades\File;

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

        foreach ($day->event_reports as $report) {
            if ($report->has('media')) { 
                if (File::exists($report->getFirstMediaUrl('event-report', 'main-thumb2'))?true:false) { 
                $imgResource[] = [
                'thumbnail' => $report->getFirstMediaUrl('event-report', 'main-thumb2'),
                'main' => $report->getFirstMediaUrl('event-report', 'main-image')
                ];
            }
            }
        }

        // dd($day->event_reports);

        return $imgResource;
    }
}
