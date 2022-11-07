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

    // return EventGameTable::select(['title', 'code'])->orderBy('title')->withCount('events')
    //         ->having('events_count', '>', 0 )->get();


        $tournaments = Tournament::orderByDesc('date_start')->with([ 'events', 'events.days','events.days.event_reports', 'tour', 'currency', 'country',  'events.tournament',  'events.event_game_table'])
        ->withCount('events')->having('events_count', '>', 0);

        return  new LOFApiTournamentCollection($request->get('status') == 'live' ? $tournaments->paginate(5) : $tournaments->paginate(5));
    }

    public function show($id)
    {
        return new LOFApiTournamentResource(Tournament::with('media')->where('id', $id)->first());
    }
}
