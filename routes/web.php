<?php

use Inertia\Inertia;
use App\Models\MenuItem;
use App\Models\EventChip;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Inertia\HomeController;
use App\Http\Controllers\Inertia\PageController;
use App\Http\Controllers\Inertia\EventController;
use App\Http\Controllers\Inertia\ReportController;
use App\Http\Controllers\Inertia\ArticleController;
use App\Http\Controllers\Inertia\MenuItemController;
use App\Http\Controllers\Inertia\TournamentController;
use App\Http\Controllers\Admin\Utilities\ExcelUploadController;

Route::get('locale/{locale}', [LanguageController::class, 'setLocale'])->name('set-locale');

Route::get('/', [HomeController::class, 'index']);
// Route::get('/tournament', [TournamentController::class , 'index'] );

Route::get('/tournament/{page?}', [TournamentController::class, 'index']);

// Route::get('/event/{slug}/{page?}', [EventController::class, 'show']);
// Route::get('/event/{eventSlug}/report/{reportSlug}', [ReportController::class, 'show']);

Route::get('/tag/articles/{slug}', [ArticleController::class, 'tag'])->name('article');

Route::prefix('news')->group(function () {

    Route::get('/', [ArticleController::class, 'index'])->name('article');
    Route::get('/category', [ArticleController::class, 'index'])->name('article-category');
    Route::get('/{year}/{month}/{slug}', [ArticleController::class, 'show'])->name('article-show');

});

Route::prefix('tours')->group(function () {

    Route::get('/', [TournamentController::class, 'index']);
    Route::get('/{pages}', [TournamentController::class, 'index']);
    Route::get('/{tour}/{series}/{eventSlug}', [EventController::class, 'show']);
    Route::get('/{tour}/{series}/{eventSlug}/{reportSlug}', [ReportController::class, 'show'])->where('reportSlug', '(\w+\-\d+)');
    Route::get('/{tour}/{series}/{eventSlug}/{type?}/{day?}', [EventController::class, 'show']);
});


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::post('prepare', [ExcelUploadController::class, 'prepare']);
Route::post('upload_excel', [ExcelUploadController::class, 'upload']);
// app(MenuItemController::class)->index();

try {
    foreach (MenuItem::getTree() as $item) {
        if ($item->link == null) {
            return;
        }

        foreach ($item->children as $child) {
            if ($item->link === $child->link) {
                Route::get($item->link, function () use ($item) {
                    return Inertia::render('Categories/CategoryPage', [
                        'title' => $item->name.' | LifeOfPoker',
                        'description' => $item->name,
                        'page' => $item->link,
                    ]);
                });
            }

            Route::get($item->link.'/'.$child->link, function () use ($child) {
                return Inertia::render('Categories/CategoryPage', [
                    'title' => $child->name.' | LifeOfPoker',
                    'description' => $child->name,
                    'page' => $child->link,
                ]);
            });
        }
    }
} catch (Exception $e) {
}
Route::get('/{page}/{other?}', [PageController::class, 'index']);

//for dev
Route::get('admin/player_history/{id}', function ($id) {
    return view('vendor.backpack.page.player_chips_history', [
        'chips' => EventChip::with('event')->orderByDesc('updated_at')->where('player_id', $id)->limit(10)->get(),
    ]);
});
