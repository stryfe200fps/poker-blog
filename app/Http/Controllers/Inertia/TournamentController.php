<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TournamentController extends Controller
{
    public function index($page = null)
    {
        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url()
        ]);
        return Inertia::render('Tournament/Index', [
            'page' => $page ?? 'live',
            'json-ld-webpage' => $webPage,
        ]);
    }
}
