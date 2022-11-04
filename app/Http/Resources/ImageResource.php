<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'xs-image' => $this->getUrl('xs-image'),
            'md-image' => $this->getUrl('md-image'),
            'lg-image' => $this->getUrl('lg-image'),
            'sm-image' => $this->getUrl('sm-image'),
            'xl-image' => $this->getUrl('xl-image'),
        ];
    }
}
