<?php

namespace App\Http\Controllers;

use App\Models\EventReport;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Helpers\LiveReportOrder;
use App\Helpers\LiveReportFilterByDays;
use App\Http\Resources\LOFApiLiveReportsResource;
use App\Http\Resources\LOFApiEventReportsResource;

class EventReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {

    //     // return LOFApiEventReportsResource::collection(EventReport::all());

    //     return LOFApiEventReportsResource::collection(EventReport::with(['player', 'article_author', 'level', 'event_chips', 'event_chips.player', 'event_chips.player.country'])->latest()->where('event_id', request()->all()['event'])->paginate(10));
    // }


    public function index()
    {
   
        // return LOFApiEventReportsResource::collection(EventReport::with(['player', 'article_author', 'level', 'event_chips', 'event_chips.player', 'event_chips.player.country'])->where('event_id', request()->all()['event'])->paginate(10));
        $liveReport = EventReport::with(
            ['player', 'article_author', 'level' => function ($q){ 
                $q->orderByDesc('level');
            }, 'event_chips', 
            'event_chips.player', 'event_chips.player.country'])
             ->where('event_id', request()->all()['event'])
             ;


        $pipe = app(Pipeline::class)
        ->send($liveReport)
            ->through([
            LiveReportOrder::class,
            LiveReportFilterByDays::class
            ])
           ->thenReturn();

        return LOFApiEventReportsResource::collection($pipe->paginate(100));
    }


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
     return  new LOFApiEventReportsResource(EventReport::where('slug', $slug)->first());
    }

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
