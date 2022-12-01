<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaReportingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'link' => $this->link,
            'published_date' => $this->published_date,
            'show_homepage' => $this->show_homepage,
            'categories' => $this->media_reporting_categories->map->only(['title', 'slug']),
            'image_set' => $this->allMedia()
        ];
    }
}
