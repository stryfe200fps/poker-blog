<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\LOFApiTournamentResource;
use App\Http\Resources\TournamentResource;
use App\Models\Tournament;
use Illuminate\Routing\Controller;

class TournamentApiController extends Controller
{
    public function index()
    {
        // return  TournamentResource::collection(Tournament::with(['poker_tour', 'poker_events'])->latest()->paginate(10));
    }

    public function show($slug)
    {
        return new LOFApiTournamentResource(Tournament::where('slug', $slug)->first());
    }
}
