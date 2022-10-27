<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use App\Http\Resources\LOFApiEventReportsResource;
use App\Models\EventReport;
use Inertia\Inertia;

class ReportController extends Controller
{
    // public function show($tour, $series, $eventSlug,  $reportSlug) {
    public function show($eventSlug, $reportSlug)
    {
        // Route::get('/tours/{tour}/{series}/{eventSlug}/report/{re}', [ReportController::class, 'show'] );

        $report = new LOFApiEventReportsResource(EventReport::where('slug', $reportSlug)->firstOrFail());

        return Inertia::render('Report/Show', [
            'report' => $report,
            'title' => $report->title.' | LifeOfPoker',
            'slug' => $reportSlug,
            'image' => $report->getFirstMediaUrl('event-report', 'main-image'),
            'description' => \Illuminate\Support\Str::limit($report->title, 100, $end = '...'),
        ]);
    }
}
