<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    public function toArray($request)
    {
        $dateNow = Carbon::now();

        $dateStart = Carbon::parse($this->date_start);
        $dateEnd = Carbon::parse($this->date_end);

        // $status = '';
        // if ($dateNow >= $dateStart && $dateNow <= $dateEnd) {
        //     $status = 'live';
        // } elseif ($dateNow <= $dateStart->addDay(2)) {
        //     $status = 'upcoming';
        // } else {
        //     $status = 'past';
        // }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => googleTranslateExclude($this->title)[0] ?? '',
            'title_tab' => $this->title ?? '',
            'content' => googleTranslateExclude($this->content),
            'description' => $this->description,
            'poker_tour' => $this->tour->title,
            'poker_tour_slug' => $this->tour->slug,
            'main_image' => $this->getFirstMediaUrl('tournament', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('tournament', 'main-thumb'),
            'currency' => $this->currency,
            'timezone' => $this->word_timezone,
            'number_timezone' => $this->minimized_timezone,
            'country' => $this->country,
            'realtime_date_start' => Carbon::parse($this->date_start)->setTimezone($this->word_timezone)->format(config('app.carbon_date_format')),
            'realtime_date_end' => Carbon::parse($this->date_start)->setTimezone($this->word_timezone)->format(config('app.carbon_date_format')),
            'date_start' => Carbon::parse($this->date_start)->toFormattedDateString(),
            'date_end' => Carbon::parse($this->date_end)->toFormattedDateString(),
            'events' => new LOFApiEventsCollection($this->events),
        ];
    }
}
