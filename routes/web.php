<?php

use Inertia\Inertia;
use App\Models\MenuItem;
use App\Models\EventChip;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inertia\HomeController;
use App\Http\Controllers\Inertia\PageController;
use App\Http\Controllers\Inertia\EventController;
use App\Http\Controllers\Inertia\ReportController;
use App\Http\Controllers\Inertia\ArticleController;
use App\Http\Controllers\Inertia\MenuItemController;
use App\Http\Controllers\Inertia\TournamentController;
use App\Http\Controllers\Admin\Utilities\ExcelUploadController;
use App\Http\Controllers\Inertia\RoomController;
use App\Models\Tournament;
use App\Http\Resources\LOFApiTournamentResource;
Route::get('/', [HomeController::class, 'index']);
// Route::get('/tournament', [TournamentController::class , 'index'] );



// Route::get('/event/{slug}/{page?}', [EventController::class, 'show']);
// Route::get('/event/{eventSlug}/report/{reportSlug}', [ReportController::class, 'show']);

Route::get('/tag/articles/{slug}', [ArticleController::class, 'tag'])->name('article');

Route::prefix('news')->group(function () {

    Route::get('/', [ArticleController::class, 'index'])->name('article');
    Route::get('/{slug}', function ($slug) {
 
        return Inertia::render('Categories/CategoryPage', [
                        'title' => ucfirst(str_replace('-', ' ', $slug)) . ' | LifeOfPoker',
                        'description' => ucfirst(str_replace('-', ' ', $slug)),
                        'page_title' => ucfirst(str_replace('-', ' ', $slug)),
                    ]);
    });
    Route::get('/category', [ArticleController::class, 'index'])->name('article-category');
    Route::get('/{year}/{month}/{slug}', [ArticleController::class, 'show'])->name('article-show');

});

Route::prefix('tours')->group(function () {

    Route::get('/', [TournamentController::class, 'index']);
 
    Route::get('/{page?}', [TournamentController::class, 'index']);
    Route::get('/{tour}/{series}/{eventSlug}', [EventController::class, 'show']);
    Route::get('/{tour}/{series}/{eventSlug}/{reportId}', [ReportController::class, 'show'])->where('reportId', '(\w+\-\d+)');
    Route::get('/{tour}/{series}/{eventSlug}/{day?}/{type?}', [EventController::class, 'show']);
});


Route::get('tour/{tourSlug}/{seriesSlug}', function ($tourSlug,$seriesSlug) {
$tournament = Tournament::with('events')->where('slug', $seriesSlug)->firstOrFail() ;

return Inertia::render('Series/Show', [
    'title' => 'Events Calendar | LifeOfPoker',
    'series' => new LOFApiTournamentResource($tournament),
    'page_title' => 'Event Calendar',
    // 'json-ld-webpage' => 'testsssss',
 ]);
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::post('prepare', [ExcelUploadController::class, 'prepare']);
Route::post('upload_excel', [ExcelUploadController::class, 'upload']);




//  Route::get('news/{slug}', function () use ($slug) {
//                     $webPage = \JsonLd\Context::create('web_page', [
//                         'url' => request()->url()
//                     ]);
//                     return Inertia::render('Categories/CategoryPage', [
//                         // 'title' => $item->name.' | LifeOfPoker',
//                         // 'description' => $item->name,
//                         // 'page' => $item->link,
//                         // 'page_title' => $child->name,
//                         // 'json-ld-webpage' => $webPage,
//                     ]);
// });
                
// app(MenuItemController::class)->index();

// try {
//     foreach (MenuItem::getTree() as $item) {
//         if ($item->link == null) {
//             return;
//         }

//         foreach ($item->children as $child) {
//             if ($item->link === $child->link) {
//                 Route::get($item->link, function () use ($item, $child) {
//                     $webPage = \JsonLd\Context::create('web_page', [
//                         'url' => request()->url()
//                     ]);
//                     return Inertia::render('Categories/CategoryPage', [
//                         'title' => $item->name.' | LifeOfPoker',
//                         'description' => $item->name,
//                         'page' => $item->link,
//                         'page_title' => $child->name,
//                         'json-ld-webpage' => $webPage,
//                     ]);
//                 });
//             }

//             Route::get($item->link.'/'.$child->link, function () use ($child) {
//                 $webPage = \JsonLd\Context::create('web_page', [
//                     'url' => request()->url()
//                 ]);
//                 return Inertia::render('Categories/CategoryPage', [
//                     'title' => $child->name.' | LifeOfPoker',
//                     'description' => $child->name,
//                     'page' => $child->link,
//                     'page_title' => $child->name,
//                     'json-ld-webpage' => $webPage,
//                 ]);
//             });
//         }
//     }
// } catch (Exception $e) {
// }

Route::get('/events-calendar', function () {
 return Inertia::render('Event/EventCalendar', [
    'title' => 'Events Calendar | LifeOfPoker',
    // 'description' => 'desc',
    // 'page' => 'tests',
    'page_title' => 'Event Calendar',
    // 'json-ld-webpage' => 'testsssss',
 ]);
});


// Route::get('/rooms', [ RoomController::class, 'index' ]);
Route::get('/rooms/{slug}', [ RoomController::class, 'show' ]);

Route::get('/{page}/{other?}', [PageController::class, 'index']);


//for dev
Route::get('admin/player_history/{id}', function ($id) {
    return view('vendor.backpack.page.player_chips_history', [
        'chips' => EventChip::with('event')->orderByDesc('updated_at')->where('player_id', $id)->limit(10)->get(),
    ]);
});
