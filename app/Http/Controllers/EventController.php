<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Tournament;
use Illuminate\Http\Request;
use App\Http\Filters\DateFilter;
use App\Http\Filters\GameFilter;
use App\Http\Filters\TourFilter;
use Illuminate\Pipeline\Pipeline;
use App\Http\Filters\LocationFilter;
use App\Http\Resources\CalendarTournamentCollection;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return EventResource::collection(Event::getLiveEvents()->showLatest()->take(2)->get());

        // return  EventResource::collection(Event::latest()->get()->filter(function ($item) {
        //     return $item->status() == 'live';
        // })->slice(0, 2));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return new EventResource(Event::with(['event_reports'])->where('slug', $slug)->first());
    }

    public function calendar()
    {
        $series = Tournament::with('tour')->orderBy('date_start', 'ASC');

        $pipeLine = app(Pipeline::class)
            ->send($series)
            ->through([
                DateFilter::class,
                LocationFilter::class,
                GameFilter::class,
                TourFilter::class
            ])
            ->thenReturn()
            ->paginate(3);

        return new CalendarTournamentCollection($pipeLine);
    }
}
