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
    Route::crud('events', 'EventCrudController');
    Route::crud('report', 'EventReportCrudController');
    Route::crud('all-reports', 'AllReportsCrudController');
    Route::crud('poker-tour', 'TourCrudController');
    Route::crud('series', 'TournamentCrudController');
    Route::crud('article-category', 'ArticleCategoryCrudController');
    Route::crud('live-report-player', 'EventChipCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('player', 'PlayerCrudController');
    Route::crud('chip-count', 'ChipCountCrudController');
    Route::crud('payout', 'PayoutCrudController');
    Route::crud('live', 'LiveCrudController');
    Route::crud('level', 'LevelCrudController');
    Route::crud('article-author', 'ArticleAuthorCrudController');
    Route::crud('image-theme', 'ImageThemeCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('day', 'DayCrudController');
}); // this should be the absolute last line of this file