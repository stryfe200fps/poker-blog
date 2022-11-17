<?php

namespace App\Http\Controllers\Inertia;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventReportResource;
use App\Models\EventReport;
use Inertia\Inertia;

class ReportController extends Controller
{
    public function show($tour, $series, $eventSlug,  $reportId) {

        $newId = explode('-', $reportId);
        if (count($newId) <= 1) {
            return redirect('/');
        }
        $findReport = EventReport::find($newId[1]);
        $report = new EventReportResource($findReport);

        $reportEventSlug = $report->event->slug;
        $reportTourSlug = $report->event->tournament->tour->slug;
        $reportTournamentSlug = $report->event->tournament->slug;

        if ($tour != $reportTourSlug || $series != $reportTournamentSlug   || $eventSlug != $reportEventSlug ) {
            return redirect('/tours/'. $reportTourSlug . '/'. $reportTournamentSlug  . '/'. $reportEventSlug . '/'. $reportId );
        }
        $webPage = \JsonLd\Context::create('web_page', [
            'url' => request()->url()
        ]);
        return Inertia::render('Report/Show', [
            'report' => $report,
            'title' => $report->title.' | LifeOfPoker',
            'slug' => $reportId,
            'image' => $report->socialImage === '' ? null : $report->socialImage,
            'description' => \Illuminate\Support\Str::limit($report->title, 100, $end = '...'),
            'json-ld-webpage' => $webPage,
        ]);
    }
}
