<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TournamentEventResource;
use App\Models\Tournament;
use Illuminate\Routing\Controller;

class TournamentApiController extends Controller
{
    public function index()
    {
        // return  TournamentEventResource::collection(Tournament::with(['poker_tour', 'poker_events'])->latest()->paginate(10));
    }

    public function show($slug)
    {
        return new TournamentEventResource(Tournament::where('slug', $slug)->first());
    }
}
