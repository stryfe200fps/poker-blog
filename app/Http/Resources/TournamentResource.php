<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => googleTranslateExclude($this->title)[0] ?? '',
            'title_tab' => $this->title ?? '',
            'content' => googleTranslateExclude($this->content),
            'description' => $this->description,
            'poker_tour' => $this->tour->title,
            'poker_tour_slug' => $this->tour->slug,
            'image_set' => $this->allMedia(),
            'currency' => $this->currency,
            'timezone' => $this->word_timezone,
            'number_timezone' => $this->minimized_timezone,
            'country' => new CountryResource($this->country),
            'realtime_date_start' => Carbon::parse($this->date_start)->setTimezone($this->word_timezone),
            'realtime_date_end' => Carbon::parse($this->date_end)->setTimezone($this->word_timezone),
        ];
    }
}
