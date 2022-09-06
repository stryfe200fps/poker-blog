<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
Route::crud('article', 'ArticleCrudController');
    Route::crud('event-schedule', 'EventScheduleCrudController');
    Route::crud('live-report', 'LiveReportCrudController');
    Route::crud('poker-tour', 'PokerTourCrudController');
    Route::crud('poker-tournament', 'PokerTournamentCrudController');
    Route::crud('poker-tournament', 'PokerTournamentCrudController');
    Route::crud('article-category', 'ArticleCategoryCrudController');
    Route::crud('live-report-player', 'LiveReportPlayerCrudController');
}); // this should be the absolute last line of this file
