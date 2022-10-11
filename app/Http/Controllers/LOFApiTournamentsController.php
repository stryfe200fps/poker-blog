<?php

namespace App\Http\Controllers;

use App\Http\Resources\LOFApiTournamentCollection;
use App\Http\Resources\LOFApiTournamentResource;
use App\Models\Tournament;

class LOFApiTournamentsController extends Controller
{
    public function index()
    {
        // return  LOFApiTournamentResource::collection(Tournament::latest()->latest()->paginate(10));

        return  new LOFApiTournamentCollection(Tournament::latest()->get());
    }

    public function show($id)
    {
        return new LOFApiTournamentResource(Tournament::with('media')->where('id', $id)->first());
    }
}
