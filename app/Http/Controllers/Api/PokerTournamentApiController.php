<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TournamentResource;
use App\Models\Tournament;
use Illuminate\Routing\Controller;

class TournamentApiController extends Controller
{
    public function index()
    {
        return  TournamentResource::collection(Tournament::with(['poker_tour', 'poker_events'])->latest()->paginate(10));
    }

    public function show($id)
    {
        return new TournamentResource(Tournament::where('slug', $id)->first());
    }
}
