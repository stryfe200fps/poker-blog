<?php


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



test('imagetheme is attaching to event report', function () {
    $image = ImageTheme::factory()->create([
        'name' => 'flame_butane',
    ]);

    $img = UploadedFile::fake()->image('photo.jpg');
    $image->addMedia($img)
            ->toMediaCollection('image-theme');

    $report = EventReport::factory()->create([
        'image_theme_id' => $image->id,
    ]);

    expect($report->image_theme->image)->toBe(config('app.url').'/storage/1/photo.jpg');

});
