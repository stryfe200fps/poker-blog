<?php

namespace App\Http\Controllers;

use App\Http\Resources\LOFApiTournamentCollection;
use App\Http\Resources\LOFApiTournamentResource;
use App\Models\Tournament;
use Illuminate\Http\Request;

class LOFApiTournamentsController extends Controller
{
    // public function index()
    // {
    //     // dd(Tournament::latest()->get());

    //     return  new LOFApiTournamentCollection(Tournament::latest()->get());
    // }
    public function index(Request $request)
    {

        $tournaments = Tournament::with([ 'events', 'events.days','events.days.event_reports', 'tour', 'currency', 'country',  'events.tournament',  'events.event_game_table'])->latest();

        return  new LOFApiTournamentCollection($request->get('status') == 'live' ? $tournaments->get() : $tournaments->get());
    }

    public function show($id)
    {
        return new LOFApiTournamentResource(Tournament::with('media')->where('id', $id)->first());
    }
}
