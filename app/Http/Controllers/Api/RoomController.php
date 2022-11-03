<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {

       $rooms = Room::with(['country'])->latest();

       if (request()->has('country')) {
        $rooms->whereHas('country', function ($country) {
            $country->where('iso_3166_2', request()->get('country'));
        });
       }

       return RoomResource::collection($rooms->paginate(6));
    }
}
