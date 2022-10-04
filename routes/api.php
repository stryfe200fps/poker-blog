<?php

use Illuminate\Http\Request;
use App\Http\Controllers\PageManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\PageManagerController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\levelApiController;
use App\Http\Controllers\EventReportsController;
use App\Http\Controllers\LOFApiEventsController;
use App\Http\Controllers\Api\LiveReportController;
use App\Http\Controllers\Api\ReportsApiController;
use App\Http\Resources\LOFPokerTournamentResource;
use App\Http\Controllers\LOFApiEventIndexController;
use App\Http\Controllers\Api\TournamentApiController;
use App\Http\Controllers\LOFApiLiveReportsController;
use App\Http\Controllers\LOFApiTournamentsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('article', ArticleController::class);
Route::get('article/{slug}/related', [ArticleController::class, 'related' ]);

// Route::get('article/tag/{tag}', [ArticleController::class, 'tag' ]);

Route::get('tag/articles/{slug}', [TagController::class, 'articles']);
Route::get('tag/reports/{slug}', [TagController::class, 'reports']);

Route::resource('live-report', LiveReportController::class);
Route::resource('tournament', TournamentApiController::class);
Route::resource('level', levelApiController::class);
Route::get('live-report/view/{id}', [LiveReportController::class, 'view']);
Route::get('events', [EventApiController::class, 'index']);

Route::post('events/gallery/upload', [EventApiController::class, 'upload']);

Route::get('events/gallery/fetch/{id}', [EventApiController::class, 'fetchGallery']);
Route::delete('events/gallery/delete/{id}', [EventApiController::class, 'deleteImage']);

Route::get('events/{id}', [EventApiController::class, 'show']);
Route::post('events/{id}', [EventApiController::class, 'show']);

Route::resource('reports', ReportsApiController::class);

Route::resource('lof-tournament', LOFApiTournamentsController::class);
Route::resource('lof-event', LOFApiEventsController::class);
Route::resource('lof-event-index', LOFApiEventIndexController::class);
Route::resource('lof-live-report', EventReportsController::class);

Route::resource('page', PageManagerController::class);
