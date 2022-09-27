<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Models\Article;
use App\Models\EventPayout;
use App\Models\EventReport;
use App\Models\Payout;
use App\Models\Player;
use Illuminate\Support\Facades\Schema;
use Rap2hpoutre\FastExcel\FastExcel;
use Backpack\PageManager\app\Models\Page;
use App\Http\Resources\LOFApiEventReportsResource;


Route::get('/', function () {

    return Inertia::render('Index',[  
        'title' => 'Life of poker',
        'description' =>'life of poker' 
    ]);
});

Route::get('/event/{id}', function ($id) {
    return Inertia::render('Event/Index', [
        'id' => $id
    ]);
})->name('event');

Route::get('/report/{slug}', function ($slug) {
    $report = new LOFApiEventReportsResource(EventReport::where('slug', $slug)->first());
      return Inertia::render('Report/Show', [
        'report' => $report,
        'title' => $report->title,
        'slug' => $slug,
         'image' => $report->getFirstMediaUrl('event-report', 'main-image'),
        'description' => \Illuminate\Support\Str::limit($report->title, 100, $end='...') 
    ]);
})->name('event');



Route::get('/tournament', function () {
    return Inertia::render('Tournament/Index');
})->name('tournament');

Route::get('/article', function () {
    return Inertia::render('Article/Index');
})->name('article');


Route::get('/article/show/{slug}', function ($slug) {
$article = Article::where('slug', $slug)->first();

    return Inertia::render('Article/Show', 
    [
        'title' => $article->title,
        'slug' => $slug,
        'image' => $article->image,
        'description' => \Illuminate\Support\Str::limit($article->description, 100, $end='...') 
    ]);
})->name('article-show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('admin/live_events', function () {
    return view('vendor.backpack.page.live_events');
});

Route::post('filepond', function () {
});

Route::post('prepare', function () {
    try {
        $realName = request()->all()['file']->getClientOriginalName();
        request()->all()['file']->move('uploads', $realName);
        $collection = (new FastExcel)->import('uploads/'.$realName);
        $header = array_values(collect(Schema::getColumnListing('event_payouts'))->filter(fn ($z) => $z == 'player_id' || $z == 'prize' || $z == 'country')->toArray());

        return [
            'excel_header' => array_keys($collection[0]),
            'main_header' => $header,
        ];

        return 1;
    } catch (Exception $e) {
        return 0;
    }
});

Route::post('upload_excel', function () {

    if (!request()->all()['checkbox_overwrite']) {
        EventPayout::where('event_id', request()->all()['event_id'])->delete();
    }

    try {
        $realName = request()->all()['file']->getClientOriginalName();
        request()->all()['file']->move('uploads', $realName);
        $currentHeader = json_decode(request()->all()['headers'], true);
        // dd(array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'prize')->toArray())[0]['prize']);
        $check = (new FastExcel())->import('uploads/'.$realName, function ($line) use ($currentHeader) {
            $player = $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'player_id')->toArray())[0]['player_id']];

            $playerArray = explode(' ', trim($player));

            if (is_countable($playerArray) && count($playerArray) === 2) {
                $player = Player::where('name', $playerArray[0].' '.$playerArray[1])->first();
                if ($player !== null) {
                    $save = EventPayout::create([
                        'prize' => $line[array_values(collect($currentHeader)->filter(fn ($a) => array_key_first($a) === 'prize')->toArray())[0]['prize']],
                        'event_id' => request()->all()['event_id'],
                        'player_id' => $player->id,
                    ]);
                }
            }
        });

        return 1;
    } catch (Exception $e) {
        return 0;
    }
});

Route::get('/{page}', function ($page) {
    if ($page = Page::findBySlug($page)) {
        return Inertia::render('Template/Index', [
            'title' => $page->name,
            'description' => \Illuminate\Support\Str::limit($page->name, 100, $end='...') ,
            'page' => $page
        ]);
    } else {
            return Inertia::render('Error/404');    
    }
});

