<?php

namespace App\Http\Controllers;

use App\Http\Resources\InstagramResource;
use App\Http\Resources\TwitterResource;
use App\Models\SocialMedia;
use Dymantic\InstagramFeed\Profile;
use Exception;

class SocialMediaController extends Controller
{
    public function fetchTwitter()
    {
        return TwitterResource::collection(SocialMedia::where('type', 'twitter')->limit(2)->get());
    }

    public function fetchInstagram()
    {
        try { 
        $profile = Profile::where('username', env('INSTAGRAM_USERNAME'))->first();
        return InstagramResource::collection(collect($profile->feed(1)));
        } catch (Exception $e) { }
    }
}
