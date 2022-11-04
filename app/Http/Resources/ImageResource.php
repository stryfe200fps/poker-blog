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
            'xs_image' => $this->getUrl('xs-image'),
            'md_image' => $this->getUrl('md-image'),
            'lg_image' => $this->getUrl('lg-image'),
            'sm_image' => $this->getUrl('sm-image'),
            'xl_image' => $this->getUrl('xl-image'),
            'og_image' => $this->getUrl(),
        ];
    }
}
