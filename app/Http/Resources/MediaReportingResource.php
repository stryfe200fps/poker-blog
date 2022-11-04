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
            'description' => $this->title,
            'type' => $this->type,
            'link' => $this->title,
            'published_date' => $this->published_date,
            'author' => $this->author->full_name,
            'image_set' => ImageResource::collection($this->getMedia('media-reporting'))
        ];
    }
}
