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
        $tournaments = $tour->tournaments();
     
        if (request()->get('year')) {
            $tournaments->whereYear('date_start', request()->get('year'));
        }
        return [ 
        'tournaments' =>  $tournaments->with('country')->paginate(10),
        'tour' => $tour->withoutRelations('tournaments'),
        ] ;
    }
}
