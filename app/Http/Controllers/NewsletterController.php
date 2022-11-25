<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use Newsletter;

// use Spatie\Newsletter\Newsletter;

class NewsletterController extends Controller
{
    public function store(NewsletterRequest $request)
    {
        Newsletter::subscribe($request->email);
    }
    //
}
