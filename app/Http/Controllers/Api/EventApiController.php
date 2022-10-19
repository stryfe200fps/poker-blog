<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Day;
use App\Models\Event;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventApiController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::with(['payouts', 'poker_tournament' => function ($q) {
            $q->with('poker_tour');
        }])->latest()->paginate(10));
    }

    public function show($id)
    {
        return new EventResource(Event::with(
            [
                'live_reports',  'live_reports.media', 'live_report_players',
                'live_report_players.player', 'live_report_players.player.country',
                'payouts.player', 'payouts', 'live_reports.article_author', ])->where('id', $id)->first());
    }

    public function upload(Request $request)
    {
        $day = Day::where('event_id', request()->get('event_id'))->where('id', request()->get('day_id'))->firstOrFail();


        if ($request->file('image')) {
             $day->addMediaFromRequest('image')
                    ->toMediaCollection('event_gallery');
        }

        return 200;
    }

    public function fetchGallery($dayId)
    {

        $day = Day::where('id', $dayId)->first();

        $imgResource = [];

        foreach ($day->getMedia('event_gallery') as $media) {
            $imgResource[] = [
                'id' => $media->id,
                'thumbnail' => $media->getUrl('main-gallery-thumb'),
                'main' => $media->getUrl('main-gallery'),
            ];
        }

        return $imgResource;
    }

    public function deleteImage($id)
    {
        $media = Media::where('id', $id)->first();
        $eventId = $media->model_id;
        $media->delete();

        return $this->fetchGallery($eventId);
    }
}
