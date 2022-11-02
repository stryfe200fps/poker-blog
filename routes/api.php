<?php

use App\Models\ImageTheme;
use Illuminate\Http\Request;
use App\Models\EventGameTable;
use App\Http\Resources\GameResources;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ChipController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\PageManagerController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\Api\EventApiController;
use App\Http\Controllers\Api\levelApiController;
use App\Http\Controllers\EventReportsController;
use App\Http\Controllers\LOFApiEventsController;
use App\Http\Controllers\Api\LiveReportController;
use App\Http\Controllers\Api\ReportsApiController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\LOFApiEventIndexController;
use App\Http\Controllers\LOFApiTournamentsController;
use App\Models\Tour;
use Webpatser\Countries\Countries;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('article', ArticleController::class);
Route::get('article/{slug}/related', [ArticleController::class, 'related']);
Route::get('article/{slug}', [ArticleController::class, 'article']);
Route::get('article/category/{slug}', [ArticleController::class, 'articleCategory']);

Route::get('category/article', [ArticleCategoryController::class, 'index']);
// Route::get('article/category/all', [ArticleController::class, 'category']);
Route::get('tag/articles/{slug}', [TagController::class, 'articles']);
Route::get('tag/reports/{slug}', [TagController::class, 'reports']);
// Route::resource('live-report', LiveReportController::class);



Route::resource('tournament', PokerTournamentApiController::class);
Route::resource('level', levelApiController::class);
// Route::get('live-report/view/{id}', [LiveReportController::class, 'view']);
Route::get('events', [EventApiController::class, 'index']);
Route::post('events/gallery/upload', [EventApiController::class, 'upload']);
Route::get('events/gallery/fetch/{dayId}', [EventApiController::class, 'fetchGallery']);
Route::delete('events/gallery/delete/{dayId}', [EventApiController::class, 'deleteImage']);
Route::get('events/{id}', [EventApiController::class, 'show']);
Route::post('events/{id}', [EventApiController::class, 'show']);
Route::resource('reports', ReportsApiController::class);
Route::resource('lof-tournament', LOFApiTournamentsController::class);

Route::resource('lof-event', LOFApiEventsController::class);

Route::resource('lof-event/{slug}/payout', LOFApiEventsController::class);

// Route::get('lof-event/{slug}/chipcount', [LOFApiEventIndexController::class, 'chipCounts']);
// Route::get('lof-event/{slug}/whatsapp', [LOFApiEventIndexController::class, 'whatsapp']);

Route::resource('lof-event-index', LOFApiEventIndexController::class);
Route::resource('lof-live-report', EventReportsController::class);
Route::resource('page', PageManagerController::class);

Route::get('twitter', [SocialMediaController::class, 'fetchTwitter']);
Route::get('instagram', [SocialMediaController::class, 'fetchInstagram']);
Route::post('contact', [ContactUsController::class, 'store']);
Route::post('subscribe', [NewsletterController::class, 'store']);

Route::get('payout/player/{player_id}/event/{event}', [PayoutController::class, 'player']);

Route::get('payout/event/{slug}', [PayoutController::class, 'event_payout']);


Route::get('chip/day/{id}', [ChipController::class, 'event_chip']);
Route::get('chip/day/{id}/whatsapp', [ChipController::class, 'whatsapp']);

Route::get('gallery/day/{id}', [GalleryController::class, 'gallery']);
// Route::get('whatsapp/day/{id}', [WhatsappController::class, 'whatsapp_chip']);

Route::get('admin/attach-image/{id}', function ($id) {
    return ImageTheme::find($id)->image ?? '';
});


Route::get('select/games', function () {
    return [ 'data' => EventGameTable::get(['title', 'code']) ];
});

Route::get('select/tours', function () {
    return [ 'data' => Tour::get(['title', 'slug']) ];
});

Route::get('select/countries', function () {
    return [ 'data' => Countries::get(['full_name', 'iso_3166_2']) ];
});



