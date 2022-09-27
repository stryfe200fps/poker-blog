<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LOFApiEventIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function toArray($request)
    {
        $imgResource = [];
        foreach ($this->getMedia('event_gallery') as $media) {
            $imgResource[] = [
                'thumbnail' => $media->getUrl('main-gallery-thumb'),
                'main' => $media->getUrl(),
            ];
        }

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
            'status' => $status,
            'main_image' => $this->getFirstMediaUrl('event', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('event', 'main-thumb'),
            'gallery' => $imgResource,
            'tournament' => $this->tournament->title,
            'currency' => $this->tournament->currency,
            'available_days' => $this->getAvailableDays(),
            'tour' => $this->tournament->tour->title,
            'payouts' => collect($this->event_payouts->load(['player', 'player.country']))->sortBy('position')->values()->all(),
            'chip_stacks' => collect(EventChipsResource::collection($this->latest_event_chips->sortByDesc('created_at')->unique('player_id')))->sortByDesc('current_chips')->values()->all() ,
        ] ;
    }
}