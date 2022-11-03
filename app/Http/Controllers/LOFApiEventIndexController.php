<?php

namespace App\Http\Controllers;

use App\Http\Filters\DateFilter;
use App\Http\Filters\GameFilter;
use App\Http\Filters\LocationFilter;
use App\Http\Filters\StatusFilter;
use App\Http\Filters\TourFilter;
use App\Http\Resources\EventCollection;
use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\LOFApiEventIndexResource;
use App\Http\Resources\LOFApiEventIndexChipCountResource;
use App\Http\Resources\ReportCollection;
use App\Http\Resources\TournamentCollection;
use App\Models\Tournament;
use Illuminate\Pipeline\Pipeline;

class LOFApiEventIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with(
            [
            'tournament.currency', 'tournament.tour', 'event_game_table'
            ]);

        $series = Tournament::with('tour')->orderBy('date_start', 'ASC');
        // dd($events, $series);

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


        return new TournamentCollection($pipeLine);
        // return LOFApiEventIndexResource::collection($pipeLine);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new LOFApiEventIndexResource(Event::with(['event_payouts'])->find($id));
    }

// Route::get('lof-event-index/{slug}/chipcount', [LOFApiEventIndexController::class, 'chipCounts']);

    public function chipCounts($slug)
    {
        return new LOFApiEventIndexChipCountResource(Event::with('latest_event_chips')->where('slug', $slug)->firstOrFail());
    }

    public function whatsapp($slug)
    {
        return new LOFApiEventIndexChipCountResource(Event::with(['latest_event_chips' => function ($query) {
            $query->where('is_whatsapp', 1);
        }])->where('slug', $slug)->firstOrFail());
    }

    // public function player($player_id, $event)
    // {
    //     try {
    //         $payout = EventPayout::where('player_id', $player_id)->where('event_id', $event)->firstOrFail();
    //         return $payout?->prize ?? '';
    //     } catch (Exception $e) {
    //         return '';
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
