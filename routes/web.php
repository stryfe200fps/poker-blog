<?php

use Inertia\Inertia;
use App\Models\MenuItem;
use App\Models\EventChip;
use App\Models\Tournament;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\TournamentEventResource;
use App\Http\Controllers\Inertia\HomeController;
use App\Http\Controllers\Inertia\PageController;
use App\Http\Controllers\Inertia\RoomController;
use App\Http\Controllers\Inertia\EventController;
use App\Http\Controllers\Inertia\ReportController;
use App\Http\Controllers\Inertia\ArticleController;
use App\Http\Controllers\Inertia\MenuItemController;
use App\Http\Controllers\Inertia\TournamentController;
use App\Http\Controllers\Admin\Utilities\ExcelUploadController;
use App\Http\Resources\TourResource;
use App\Models\Tour;

Route::get('/', [HomeController::class, 'index']);
Route::get('/tag/articles/{slug}', [ArticleController::class, 'tag'])->name('article');
Route::prefix('news')->group(function () {

    Route::get('/', [ArticleController::class, 'index'])->name('article');
    Route::get('/{slug}', function ($slug) {
        return Inertia::render('Categories/CategoryPage', [
                        'title' => ucfirst(str_replace('-', ' ', $slug)) . ' | LifeOfPoker',
                        'page_title' => ucfirst(str_replace('-', ' ', $slug)),
                    ]);
    });
    Route::get('/category', [ArticleController::class, 'index'])->name('article-category');
    Route::get('/{year}/{month}/{slug}', [ArticleController::class, 'show'])->name('article-show');

});
Route::get('live-reporting/{page?}', [TournamentController::class, 'index']);
Route::prefix('tours')->group(function () {
 
    Route::get('/{tour}/{series}/{eventSlug}', [EventController::class, 'show']);
    Route::get('/{tour}/{series}/{eventSlug}/{reportId}', [ReportController::class, 'show'])->where('reportId', '(\w+\-\d+)');
    Route::get('/{tour}/{series}/{eventSlug}/{day?}/{type?}', [EventController::class, 'show']);
});


Route::get('tour/{tourSlug}/{seriesSlug}', function ($tourSlug,$seriesSlug) {
$tournament = Tournament::with('events')->where('slug', $seriesSlug)->firstOrFail() ;

return Inertia::render('Series/Show', [
    'title' => $tournament->title.' | LifeOfPoker',
    'series' => new TournamentEventResource($tournament),
    'page_title' => 'Event Calendar',
    'description' => $tournament->description,
 ]);
});


Route::get('tours/{tourSlug}', function ($tourSlug) {
    if ($tourSlug !== 'undefined') { 
        $tour = new TourResource(Tour::where('slug', $tourSlug)->firstOrFail()) ;

        return Inertia::render('Template/PokerTour', [
            'title' => $tour->title. ' | LifeOfPoker',
            'tour' => $tour,
            'description' => $tour->description,
            'page_title' => $tour->title,
        ]);
    }
});



Route::post('prepare', [ExcelUploadController::class, 'prepare']);
Route::post('upload_excel', [ExcelUploadController::class, 'upload']);

Route::get('/event-calendar', function () {
 return Inertia::render('Event/EventCalendar', [
    'title' => 'Event Calendar | LifeOfPoker',
    // 'description' => 'desc',
    // 'page' => 'tests',
    'page_title' => 'Event Calendar',
    // 'json-ld-webpage' => 'testsssss',
 ]);
});


Route::get('/rooms/{slug}', [ RoomController::class, 'show' ]);
Route::get('/{page}/{other?}', [PageController::class, 'index']);

