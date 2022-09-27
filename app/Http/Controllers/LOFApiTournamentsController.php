<?php

namespace App\Http\Controllers;

use App\Http\Resources\LOFApiTournamentResource;
use App\Http\Resources\LOFPokerTournamentResource;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Http\Resources\TournamentResource;

class LOFApiTournamentsController extends Controller
{

    public function index()
    {
        return  LOFApiTournamentResource::collection(Tournament::latest()->paginate(10));
    }

    public function show($id)
    {
        return new LOFApiTournamentResource(Tournament::where('id', $id)->first());

    }
}
