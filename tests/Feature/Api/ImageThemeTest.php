<?php

use App\Models\Event;
use App\Models\EventReport;
use App\Models\ImageTheme;

test('imagetheme is attaching to event report', function () {
    $image = ImageTheme::factory()->create([
        'name' => 'flame_butane',
    ]);

    $report = EventReport::factory()->create([
        'image_theme_id' => $image->id,
    ]);

    $eventSlug = Event::find($report->event_id)->slug;
    $fetch = $this->get('api/lof-live-report?event='.$eventSlug.'&filterDay='.$report->day.'');

    dd($fetch->json());
});
