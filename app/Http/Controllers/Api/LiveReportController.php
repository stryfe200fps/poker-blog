<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LiveReport\LiveReportResource;
use App\Models\EventReport;

class LiveReportController extends Controller
{
    public function index()
    {
        return LiveReportResource::collection(EventReport::latest()->paginate(10));
    }

    public function show($id)
    {
        return  LiveReportResource::collection(EventReport::where('event_id', $id)->paginate(10));
    }

    public function view($id)
    {
        return  new LiveReportResource(EventReport::where('id', $id)->first());
    }
}
