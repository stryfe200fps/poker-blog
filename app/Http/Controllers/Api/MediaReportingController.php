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

       if (request()->has('author_id')) {
        $mediaReporting->whereHas('author', function ($author) {
            $author->where('id', request()->get('author_id'));
        });
       }

        return MediaReportingResource::collection($mediaReporting->get());
    }
}
