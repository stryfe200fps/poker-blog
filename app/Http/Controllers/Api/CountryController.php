<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {

         $search_term = $request->input('q');

        if ($search_term)
            $results = Country::where('name', 'LIKE', '%'.$search_term.'%')->paginate(5);
        else
            $results = Country::paginate(5);

        return $results;


    }
}
