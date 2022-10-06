<?php

use Inertia\Inertia;
use App\Models\Article;
use App\Models\EventChip;
use App\Models\EventPayout;
use App\Models\EventReport;
use App\Presenters\WebsitePresenter;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\HomeController;

use Backpack\PageManager\app\Models\Page;
use App\Http\Resources\LOFApiEventReportsResource;
use App\Models\MenuItem;
use Backpack\Settings\app\Models\Setting;

Route::get('/', function () {

    $webPage =  \JsonLd\Context::create('web_page', [
        'description' => 'Home page',
        'url' => config('app.url'),
    ]);


    return Inertia::render('Index',[  
        'title' => 'Life of poker',
        'description' =>'life of poker',
        'json-ld-webpage' => $webPage,
    ]);
});

Route::get('/event/{slug}', function ($slug) {
    return Inertia::render('Event/Index', [
        'slug' => $slug,
    ]);
})->name('event');

Route::get('/report/{slug}', function ($slug) { $report = new LOFApiEventReportsResource(EventReport::where('slug', $slug)->first());
    return Inertia::render('Report/Show', [
        'report' => $report,
        'title' => $report->title,
        'slug' => $slug,
        'image' => $report->getFirstMediaUrl('event-report', 'main-image'),
        'description' => \Illuminate\Support\Str::limit($report->title, 100, $end = '...'),
    ]);
})->name('event');

Route::get('/tournament', function () {
    return Inertia::render('Tournament/Index');
})->name('tournament');

Route::get('/tag/articles/{slug}', function ($slug) {
 return Inertia::render('Tag/TagArticle', [
    'slug' => $slug
 ]);
})->name('article');


Route::get('/article', function () {

    $webPage =  \JsonLd\Context::create('web_page', [
        'description' => 'Article',
        'url' => config('app.url'). '/article'
    ]);

    return Inertia::render('Article/Index');
})->name('article');

Route::get('/article/show/{slug}', function ($slug) {
    $article = Article::where('slug', $slug)->first();

    $webPage =  \JsonLd\Context::create('web_page', [
        'description' => 'Home page',
        'url' => config('app.url'). '/article/show/'. $slug,
    ]);

    $context = \JsonLd\Context::create('news_article', [
        'headline' => $article->title,
        'description' => $article->description,
        'mainEntityOfPage' => [
            'url' =>  config('app.url') . '/article',
          
        ],
        'image' => [
            'url' =>  $article->getFirstMediaUrl('article'),
            'height' => 800,
            'width' => 800,
        ],
        'datePublished' => $article->published_date,
        'dateModified' => $article->updated_at,
        'author' => [
            'name' => $article?->article_author?->first_name,
        ],
        'publisher' => [
            'name' => 'Life of poker',
            'logo' => [
                'url' =>  config('app.url') . '/lop_logo_small.png',
              'width' => 600,
              'height' => 60,
            ]
        ],
    ]);

    return Inertia::render('Article/Show', 
    [
        'title' => $article->title,
        'slug' => $slug,
        'image' => $article->image,
        'json-ld-article' => $context,
        'json-ld-webpage' => $webPage,
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

Route::get('admin/player_history/{id}', function ($id) {
    return view('vendor.backpack.page.player_chips_history', [
        'chips' => EventChip::with('event')->orderByDesc('updated_at')->where('player_id', $id)->limit(10)->get(),
    ]);
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
    if (! request()->all()['checkbox_overwrite']) {
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



Route::get('/{page}/{other?}', function ($page, $other = null) {

//     @foreach (\App\MenuItem::getTree(); as $item)
//   <a class="no-underline hover:underline p-3"
//      href="{{$item->url()}}">
//      {{ $item->name }}
//   </a> 
// @endforeach 

    if ($page = Page::findBySlug($page)) {
        return Inertia::render('Template/Index', [
            'title' => $page->name,
            'description' => \Illuminate\Support\Str::limit($page->name, 100, $end = '...'),
            'page' => $page,

        ]);
    } else {
        return Inertia::render('Error/404');
    }


});
