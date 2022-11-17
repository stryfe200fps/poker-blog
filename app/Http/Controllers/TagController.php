<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Http\Resources\EventReportResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($slug)
    {
        return Tag::where('slug', $slug)->first()->articles()->get();
    }

    public function fetch(Request $request)
    {
        $query = $request->get('query');
        return Tag::where('title', 'like', "%{$query}%" )->get()->map->only('title')->pluck('title');
    }

    public function articles($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return ArticleResource::collection($tag->articles()->paginate(10));
    }

    public function reports($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        return EventReportResource::collection($tag->event_reports()->paginate(10));
    }
}
