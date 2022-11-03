<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url()
        ]);

        return Inertia::render('Room/Index', [
            'title' => 'Rooms | LifeOfPoker',
            'json-ld-webpage' => $webPage,
        ]);
    }

    public function show($slug)
    {
        $room = Room::where('slug', $slug)->firstOrFail();
        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url()
        ]);

        return Inertia::render('Room/Show', [
            'title' => 'Room: ' .$room->title.  ' | LifeOfPoker',
            'slug' => $room->slug,
            'image' =>  $room->getFirstMediaUrl('room', 'big-image'),
            'json-ld-webpage' => $webPage,
        ]);

    }
}

