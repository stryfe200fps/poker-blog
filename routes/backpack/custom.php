<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Admin\Utilities\ExcelUploadController;

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
    Route::crud('poker-tour', 'TourCrudController');
    Route::crud('series', 'TournamentCrudController');
    Route::crud('article-category', 'ArticleCategoryCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('player', 'PlayerCrudController');
    Route::crud('chip-count', 'ChipCountCrudController');
    Route::crud('payout', 'PayoutCrudController');
    Route::crud('live', 'LiveCrudController');
    Route::crud('level', 'LevelCrudController');
    Route::crud('author', 'AuthorCrudController');
    Route::crud('image-theme', 'ImageThemeCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('day', 'DayCrudController');
    Route::crud('event-game-table', 'EventGameTableCrudController');
    Route::crud('glossary', 'GlossaryCrudController');
    Route::crud('room', 'RoomCrudController');
    Route::crud('banner', 'BannerCrudController');
    Route::crud('media-reporting', 'MediaReportingCrudController');
    Route::crud('media-reporting-category', 'MediaReportingCategoryCrudController');
    Route::crud('content', 'ContentCrudController');
    Route::crud('badge', 'BadgeCrudController');
<<<<<<< HEAD
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    Route::get('image/regenerate', [ ImageController::class, 'regenerate' ]);
    Route::post('prepare', [ExcelUploadController::class, 'prepare']);
    Route::post('upload_excel', [ExcelUploadController::class, 'upload']);
=======
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
}); // this should be the absolute last line of this file