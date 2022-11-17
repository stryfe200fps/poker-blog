<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Exception;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function show($type)
    {
        try {
            return Content::where('type', $type)->firstOrFail()->only(['content']);
        }
        catch (Exception $e) {
            return '';
        }
    }

}
