<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Resources\TwitterResource;

class SocialMediaController extends Controller
{

    public function fetchTwitter()
    {
        return TwitterResource::collection(SocialMedia::where('type',  'twitter')->limit(2)->get());
    }
}
