<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\EventApiController as ApiEventApiController;
use App\Http\Controllers\Api\levelApiController;
use App\Http\Controllers\Api\LiveReportController;
use App\Http\Controllers\Api\TournamentApiController;
use App\Http\Controllers\Api\ReportsApiController;
use App\Http\Controllers\EventReportsController;
use App\Http\Controllers\LOFApiEventIndexController;
use App\Http\Controllers\LOFApiEventsController;
use App\Http\Controllers\LOFApiLiveReportsController;
use App\Http\Controllers\LOFApiTournamentsController;
use App\Http\Controllers\PageManager;
use App\Http\Controllers\PageManagerController;
use App\Http\Resources\LOFPokerTournamentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('article', ArticleController::class);
Route::resource('live-report', LiveReportController::class);
Route::resource('tournament', TournamentApiController::class);
Route::resource('level', levelApiController::class);
Route::get('live-report/view/{id}', [LiveReportController::class, 'view']);
Route::get('events', [ApiEventApiController::class, 'index']);

Route::post('events/gallery/upload', [ApiEventApiController::class, 'upload']);

Route::get('events/gallery/fetch/{id}', [ApiEventApiController::class, 'fetchGallery']);
Route::delete('events/gallery/delete/{id}', [ApiEventApiController::class, 'deleteImage']);

Route::get('events/{id}', [ApiEventApiController::class, 'show']);
Route::post('events/{id}', [ApiEventApiController::class, 'show']);

Route::resource('reports', ReportsApiController::class);

Route::resource('lof-tournament', LOFApiTournamentsController::class);
Route::resource('lof-event', LOFApiEventsController::class);
Route::resource('lof-event-index', LOFApiEventIndexController::class);
Route::resource('lof-live-report', EventReportsController::class);

Route::resource('page', PageManagerController::class);
// Route::get('pagemanager/show/{slug}', [PageManagerController::class, 'show']);
