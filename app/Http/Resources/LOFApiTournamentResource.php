<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiTournamentResource extends JsonResource
{
    public function toArray($request)
    {
        $dateNow = Carbon::now();

        $dateStart = Carbon::parse($this->date_start);
        $dateEnd = Carbon::parse($this->date_end);

        $status = '';
        if ($dateNow >= $dateStart && $dateNow <= $dateEnd) {
            $status = 'live';
        } elseif ($dateNow <= $dateStart->addDay(2)) {
            $status = 'upcoming';
        } else {
            $status = 'past';
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'poker_tour' => $this->tour->title,
            'main_image' => $this->getFirstMediaUrl('tournament', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('tournament', 'main-thumb'),
            'currency' => $this->currency,
            'timezone' => $this->timezone,
            'country' => $this->country,
            'date_start' => Carbon::parse($this->date_start)->toFormattedDateString(),
            'date_end' => Carbon::parse($this->date_end)->toFormattedDateString(),
            'status' => $status,
            'events' => LOFApiEventsResource::collection($this->events),
        ];
    }
}
