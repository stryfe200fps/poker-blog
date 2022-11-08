<?php

namespace App\Http\Controllers;

use App\Http\Resources\TournamentCollection;
use App\Http\Resources\TournamentResource;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index(Request $request)
    {
        $tournaments = Tournament::
        with([ 'events', 'events.days','events.days.event_reports', 'tour', 'currency', 'country',  'events.tournament',  'events.event_game_table'])
        ->groupBy('id')->withCount('events')->having('events_count', '>', 0);

        return  new TournamentCollection($request->get('status') == 'upcoming' 
        ? $tournaments->orderBy('date_start')->paginate(5) 
        : $tournaments->orderByDesc('date_start')->paginate(5));
    }

    public function show($id)
    {
        return new TournamentResource(Tournament::with('media')->where('id', $id)->first());
    }
}
