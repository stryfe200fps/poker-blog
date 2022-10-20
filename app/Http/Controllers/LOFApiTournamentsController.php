<?php

namespace App\Http\Controllers;

use App\Http\Resources\LOFApiTournamentCollection;
use App\Http\Resources\LOFApiTournamentResource;
use App\Models\Tournament;
use Illuminate\Http\Request;

class LOFApiTournamentsController extends Controller
{
    public function index()
    {
        // dd(Tournament::latest()->get());
        return  new LOFApiTournamentCollection(Tournament::latest()->paginate(5));
    }


    

    // public function show($id)
    // {
    //     return new LOFApiTournamentResource(Tournament::with('media')->where('id', $id)->first());  
    // }

    public function show(Request $request,$id)
    {
        if(is_numeric($id)) { //id of event
            return new LOFApiTournamentResource(Tournament::with('media')->where('id', $id)->first());
        }
        else{ //string, type of event
            $request->merge(['status'=>$id]);
            return  new LOFApiTournamentCollection(Tournament::latest()->get());
        }
        
    }
}
