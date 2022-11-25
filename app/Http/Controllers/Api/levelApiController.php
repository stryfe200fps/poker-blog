<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\LevelResource;
use App\Models\Level;
use Illuminate\Routing\Controller;

class levelApiController extends Controller
{
    public function index()
    {
        return  LevelResource::collection(Level::latest()->paginate(10));
        // return  LevelResource::collection(Level::with(['poker_tour', 'poker_events'])->latest()->paginate(10));
    }

    public function show($id)
    {
        return  LevelResource::collection(Level::where()->latest()->paginate(10));
        // return new LevelResource(Level::where('slug', $id)->first());
    }
}
