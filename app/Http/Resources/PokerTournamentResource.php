<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TournamentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
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
            'country_id' => $this->country,
            'currency' => $this->currency,
            'timezone' => $this->timezone,
            'description' => $this->description,
            'date_start' => Carbon::parse($this->date_start)->toFormattedDateString(),
            'date_end' => Carbon::parse($this->date_end)->toFormattedDateString(),
            'status' => $status,
            'poker_tour_id' => $this->tour_id,
            'image' => $this->getFirstMediaUrl('poker_tournaments', 'featured-image'),
            'poker_tour' => $this->poker_tour,
            'events' => EventResource::collection($this->poker_events),
        ];
    }
}
