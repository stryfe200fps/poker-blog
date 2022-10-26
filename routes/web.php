<?php
use App\Models\MenuItem;
use Inertia\Inertia;
use App\Http\Controllers\Admin\Utilities\ExcelUploadController;
use App\Http\Controllers\Inertia\ArticleController;
use App\Models\EventChip;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Inertia\HomeController;
use App\Http\Controllers\Inertia\EventController;
use App\Http\Controllers\Inertia\MenuItemController;
use App\Http\Controllers\Inertia\PageController;
use App\Http\Controllers\Inertia\ReportController;
use App\Http\Controllers\Inertia\TournamentController;


Route::get('/', [ HomeController::class, 'index' ]);
Route::get('/tournament', [TournamentController::class , 'index'] );

Route::get('/tournament/{page?}', [TournamentController::class , 'index'] );

Route::get('/event/{slug}/day/{value}', [EventController::class, 'show'] );
Route::get('/event/{slug}', [EventController::class, 'show'] );

// Route::get('/event/{slug}/day/{day}/{page?}', [EventController::class, 'showDay'] );

Route::get('/event/{eventSlug}/report/{reportSlug}', [ReportController::class, 'show'] );


Route::get('/tag/articles/{slug}', [ ArticleController::class, 'tag'])->name('article');
Route::get('/article', [ArticleController::class, 'index'])->name('article');
Route::get('/article/show/{slug}', [ArticleController::class, 'show'])->name('article-show');

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::post('prepare',  [ExcelUploadController::class , 'prepare']);
Route::post('upload_excel',[ExcelUploadController::class , 'upload'] );
// app(MenuItemController::class)->index();

try { 

    foreach (MenuItem::getTree() as $item) {
    
        if ($item->link == null)
        return ;
    
        foreach ($item->children as $child) {
            if ($item->link === $child->link) {
                Route::get($item->link, function () use ($item) {
                        return Inertia::render('Categories/CategoryPage', [
                            'title' => $item->name.' | LifeOfPoker',
                            'description' => $item->name,
                            'page' => $item->link
                        ]);
                    });
            }

            Route::get($item->link. '/' .$child->link, function () use ($child) {
                return Inertia::render('Categories/CategoryPage', [
                    'title' => $child->name.' | LifeOfPoker',
                    'description' => $child->name,
                    'page' => $child->link
                ]);
            });
        }
    } }  catch (Exception $e) {
    
    
    }
Route::get('/{page}/{other?}', [PageController::class, 'index']);

//for dev
Route::get('admin/player_history/{id}', function ($id) {
    return view('vendor.backpack.page.player_chips_history', [
        'chips' => EventChip::with('event')->orderByDesc('updated_at')->where('player_id', $id)->limit(10)->get(),
    ]);
});