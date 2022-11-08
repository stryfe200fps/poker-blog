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
        $img = $this->getMedia('media-reporting');
        $images =   is_countable($img) && count($img) > 0 ? new ImageResource( $this->getMedia('media-reporting')[0]) : '' ;

        return [
            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'link' => $this->link,
            'published_date' => $this->published_date,
            'author' => $this->author->full_name,
            'image_set' =>  $images
        ];
    }
}
