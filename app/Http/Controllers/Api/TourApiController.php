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

        $tours = Tour::latest();

        return TourResource::collection($tours->paginate(10));
    }

    public function show($slug)
    {
        $tour = Tour::with('tournaments')->where('slug', $slug)->firstOrFail();

        return [ 
        'tournaments' =>  $tour->tournaments()->whereYear('date_start', request()->get('year'))->paginate(10),
        'tour' => $tour->withoutRelations('tournaments'),
        ] ;
    }
}
