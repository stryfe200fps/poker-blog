<?php

namespace App\Http\Controllers;

use App\Http\Resources\TournamentCollection;
use App\Http\Resources\TournamentEventResource;
use App\Models\Tournament;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function index(Request $request)
    {
        $tournaments = Tournament::
        with([ 'events', 'events.days','events.days.event_reports', 'tour', 'currency', 'country',  'events.tournament',  'events.event_game_table'])
        ->whereHas('events', function ($q) {
            $q->whereHas('days');
        });

        return  new TournamentCollection($request->get('status') == 'upcoming' 
        ? $tournaments->orderBy('date_start')->paginate(5) 
        : $tournaments->orderByDesc('date_start')->paginate(5));
    }

    public function show($id)
    {
        return new TournamentEventResource(Tournament::with('media')->where('id', $id)->first());
    }
}
