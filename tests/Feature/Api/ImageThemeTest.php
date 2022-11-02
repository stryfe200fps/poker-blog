<?php

use App\Models\Event;
use App\Models\EventReport;
use App\Models\ImageTheme;
use Illuminate\Http\UploadedFile;

use function Pest\Faker\faker;

test('imagetheme is attaching to event report', function () {
    $image = ImageTheme::factory()->create([
        'name' => 'flame_butane',
    ]);

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

    $report = EventReport::factory()->create([
        'image_theme_id' => $image->id,
    ]);

    // dd($report->image_theme->image);

    expect($report->image_theme->image)->toBe(config('app.url').'/storage/1/photo.jpg');

    // $fetch = $this->get('api/lof-live-report?event='.$eventSlug.'&filterDay='.$report->day.'');

});
