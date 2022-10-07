<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstagramResource;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Resources\TwitterResource;
use Dymantic\InstagramFeed\Profile;

class SocialMediaController extends Controller
{

    public function fetchTwitter()
    {
        return TwitterResource::collection(SocialMedia::where('type',  'twitter')->limit(2)->get());
    }

    public function fetchInstagram()
    {
        $profile = Profile::where('username', env('INSTAGRAM_USERNAME'))->first();
        return InstagramResource::collection(collect($profile->feed(1)));
    }
}
