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


        $img = $this->getMedia('event');
      $images =   is_countable($img) && count($img) > 0 ? new ImageResource( $this->getMedia('event')[0]) : '' ;


        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' =>  googleTranslateExclude($this->title)[0] ?? '',
            'title_tab' => $this->title ?? '',
            'status' => $this->status(),
            'date_range' => $this->schedule,
            'image_set' => $images,
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
