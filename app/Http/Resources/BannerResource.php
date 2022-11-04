<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

      $img = $this->getMedia('banner');
      $images =   is_countable($img) && count($img) > 0 ? new ImageResource( $this->getMedia('banner')[0]) : '' ;

        return [
            'name' => $this->name,
            'location' => $this->location,
            'url' => $this->url,
            'image_set' => $images
        ];
    }
}
