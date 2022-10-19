<?php

namespace App\Http\Controllers;

use App\Http\Resources\LOFApiTournamentCollection;
use App\Http\Resources\LOFApiTournamentResource;
use App\Models\Tournament;

class LOFApiTournamentsController extends Controller
{
    public function index()
    {
        // dd(Tournament::latest()->get());
        return  new LOFApiTournamentCollection(Tournament::latest()->paginate(5));
    }


    

    public function show($id)
    {
        return new LOFApiTournamentResource(Tournament::with('media')->where('id', $id)->first());
    }
}
