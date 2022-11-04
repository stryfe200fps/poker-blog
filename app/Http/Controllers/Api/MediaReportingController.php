<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MediaReportingResource;
use App\Models\MediaReporting;
use Illuminate\Http\Request;

class MediaReportingController extends Controller
{
    public function index()
    {
        return MediaReportingResource::collection(MediaReporting::orderByDesc('published_date')->get());
    }
}
