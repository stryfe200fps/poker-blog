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

        $mediaReporting = MediaReporting::orderByDesc('published_date');

        if (request()->has('date_start')) {
            $equals = $mediaReporting->where(function ($q) {
            $q->where('published_date','>=' , request()->get('date_start'));
            });
       }

       if (request()->has('category')) {
            $mediaReporting->whereHas('media_reporting_categories', function ($country) {
            $country->where('slug', request()->get('category'));
        });
       }


        return MediaReportingResource::collection($mediaReporting->paginate(5));
    }
}
