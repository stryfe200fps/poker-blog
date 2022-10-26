<?php

namespace App\Http\Controllers\Inertia;

use Inertia\Inertia;
use App\Models\EventReport;
use App\Http\Controllers\Controller;
use App\Http\Resources\LOFApiEventReportsResource;

class ReportController extends Controller
{
    public function show($eventSlug, $reportSlug) {

    $report = new LOFApiEventReportsResource(EventReport::where('slug', $reportSlug)->first());
    return Inertia::render('Report/Show', [
        'report' => $report,
        'title' => $report->title.' | LifeOfPoker',
        'slug' => $reportSlug,
        'image' => $report->getFirstMediaUrl('event-report', 'main-image'),
        'description' => \Illuminate\Support\Str::limit($report->title, 100, $end = '...'),
    ]);
}

}