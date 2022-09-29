<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\LOFApiEventReportsResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug) {
        // dd(Tag::where('slug', $slug)->first()->event_reports()->get());
        return Tag::where('slug', $slug)->first()->articles()->get();
        // return TagResource::collection( Tag::where('title', $tag)->first()->articles->paginate(10));
    }

    public function articles($slug)
    {
       return ArticleResource::collection( Tag::where('slug', $slug)->first()->articles()->paginate(10)) ;
    }

    public function reports($slug) 
    {
       return LOFApiEventReportsResource::collection( Tag::where('slug', $slug)->first()->event_reports()->paginate(10)) ;
    }

}
