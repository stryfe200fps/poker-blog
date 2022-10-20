<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Http\Controllers\Controller;

class TournamentController extends Controller
{
    public function index($page = null) {
        return Inertia::render('Tournament/Index', [
            'page' => $page ?? 'live',
        ]);
    }
}