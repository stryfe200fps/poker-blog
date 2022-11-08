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
        // $imgResource = [];
        // foreach ($this->getMedia('event_gallery') as $media) {
        //     $imgResource[] = [
        //         'thumbnail' => $media->getUrl('main-gallery-thumb'),
        //         'main' => $media->getUrl('main-gallery'),
        //     ];
        // }

        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' =>  googleTranslateExclude($this->title)[0] ?? '',
            'title_tab' => $this->title ?? '',
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
            'buyin' => $this->buyin,
            'fee' => $this->fee,
            'game_table' => $this->event_game_table?->title,
            'description' => $this->description,
            'content' => googleTranslateExclude($this->content),
        ];
    }
}
