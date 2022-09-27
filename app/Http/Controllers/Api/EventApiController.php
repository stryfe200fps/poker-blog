<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
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
                  'payouts.player', 'payouts' , 'live_reports.article_author'])->where('id', $id)->first());
    }

    public function upload(Request $request)
    {
        $event = Event::find(request()->get('event_id'));

        if ($request->file('image')) {
            $things = $event->addMediaFromRequest('image')
                    ->toMediaCollection('event_gallery');
        }

        return 200;
    }

    public function fetchGallery($id)
    {
        $event = Event::find($id);

        $imgResource = [];

        foreach ($event->getMedia('event_gallery') as $media) {
            $imgResource[] = [
                'id' => $media->id,
                'thumbnail' => $media->getUrl('main-thumb'),
                'main' =>  $media->getUrl('main-image'),
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
