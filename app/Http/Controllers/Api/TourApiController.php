<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourApiController extends Controller
{
    public function index()
    {
        return TourResource::collection(Tour::latest()->paginate(10));
    }

    public function show($slug)
    {

        $item = Tour::with(['tournaments'])->where('slug', $slug)->firstOrFail();
        // return collect($item);
        return  new TourResource(Tour::with(['tournaments'])->where('slug', $slug)->firstOrFail());
    }
}
