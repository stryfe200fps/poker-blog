<?php

namespace App\Http\Resources;

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
                'main' => $media->getUrl('main-gallery'),
            ];
        }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' =>  googleTranslateExclude($this->title)[0] ?? '',
            'status' => $this->status(),
            'date_range' => $this->schedule,
            'main_image' => $this->getFirstMediaUrl('event', 'main-image'),
            'main_thumb' => $this->getFirstMediaUrl('event', 'main-thumb'),
            'tournament' => $this->tournament->title,
            'country' => $this->tournament->load('country')->country,
            'currency' => $this->tournament->currency,
            'available_days' => $this->getSchedule(),
            'tour_slug' => $this->tournament->tour->slug,
            'tournament_slug' => $this->tournament->slug,
            // 'tour' => $this->tournament->tour->title,
            // 'payouts' => collect($this->event_payouts->load(['player', 'player.country']))->sortBy('position')->values()->all(),
            // 'chip_stacks' => collect(EventChipsResource::collection($this->latest_event_chips->sortByDesc('date_published')->unique('player_id')))->sortByDesc('current_chips')->values()->all(),
            'buyin' => $this->buyin,
            'fee' => $this->fee,
            'game_table' => $this->event_game_table?->title,
            'description' => $this->description,
            'content' => googleTranslateExclude($this->content),
        ];
    }
}
