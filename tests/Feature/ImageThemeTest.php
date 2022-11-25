<?php

<<<<<<< HEAD

use App\Models\ImageTheme;
use App\Models\EventReport;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

$route = 'image-theme';
$model = 'ImageTheme';

it("cannot create $route if unauthenticated", fn () => 
    $this->post("admin/$route/", [
        'name' => 'adrian',
    ])->assertStatus(302)
);

it("can insert $route", fn () =>
    insert($route, 
    array_merge($game = getModel($model)->factory()->make([
        'name' => 'Things I do'
    ])
    ->attributesToArray(), ['image' => 'test.jpg'] ) )
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can update $route", fn () =>
    update($route, $model, 
    $game = getModel($model)->factory()->make([
        'name' => 'Things I do'
    ])->attributesToArray())
    ->assertDatabaseHas(getModel($model)->getTable(), $game)
);

it("can delete $route if authenticated", fn ()  =>
    delete($route, $model )
);

it("it validates when insert wrong data in $route", fn () =>  
    insert($route, [], 0)
    ->assertSessionHasErrors('name')
);


=======
use App\Models\Event;
use App\Models\EventReport;
use App\Models\ImageTheme;
use Illuminate\Http\UploadedFile;

use function Pest\Faker\faker;
>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32

test('imagetheme is attaching to event report', function () {
    $image = ImageTheme::factory()->create([
        'name' => 'flame_butane',
    ]);

<<<<<<< HEAD
    $img = UploadedFile::fake()->image('photo.jpg');
    $image->addMedia($img)
            ->toMediaCollection('image-theme');

=======
    // $path = public_path();
    // $test = faker()->file($path);
    // dd($test);

    $img = UploadedFile::fake()->image('photo.jpg');
    // dd($img);
    // $test = faker()->image($path, 200, 500, null, true, true, 'adi');

    // dd($test);

    $image->addMedia($img)
            ->toMediaCollection('image-theme');

    // dd($image->media);

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
    $report = EventReport::factory()->create([
        'image_theme_id' => $image->id,
    ]);

<<<<<<< HEAD
    expect($report->image_theme->image)->toBe(config('app.url').'/storage/1/photo.jpg');

=======
    // dd($report->image_theme->image);

    expect($report->image_theme->image)->toBe(config('app.url').'/storage/1/photo.jpg');

    // $fetch = $this->get('api/report?event='.$eventSlug.'&filterDay='.$report->day.'');

>>>>>>> add1d79f3c28592566e8c668557fa86d9e383b32
});
