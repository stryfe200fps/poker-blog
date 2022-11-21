<?php

namespace App\Http\Controllers;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return [
            'youtube_1' => Setting::get('youtube_1'),
            'youtube_2' => Setting::get('youtube_2'),
            'youtube_3' => Setting::get('youtube_3'),
        ];
    }
}
