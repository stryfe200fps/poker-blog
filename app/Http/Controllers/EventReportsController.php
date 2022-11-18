<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventReportResource;
use App\Http\Resources\ReportCollection;
use App\Models\Day;
use App\Models\Event;
use App\Models\EventReport;
use Illuminate\Http\Request;

class EventReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // dd('asd');
        $day = Day::find($request->only('day')['day']);

        $reports = $day->event_reports()
            ->with(['level', 'image_theme', 'author', 'event_chips', 'event_chips.player', 'event_chips.player.country', 'media'])
            ->orderBy('published_date', 'DESC')
            ->paginate(10);

            

        // return $reports;
        return new ReportCollection($reports);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  new EventReportResource(EventReport::where('id', $id)->first());
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
