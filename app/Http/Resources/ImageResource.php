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
    //   $modelGeneratedConversions =   collect($this->generated_conversions)->map(fn ($conversion, $key) => 
    //   $this?->getUrl($key) ?? ''
    // )->toArray() ?? [];
    return [
      'xs_image' =>  $this?->getUrl('xs-image'),
      'sm_image' =>  $this?->getUrl('sm-image'),
      'md_image' =>  $this?->getUrl('md-image'),
      'lg_image' =>  $this?->getUrl('lg-image'),
      'xl_image' =>  $this?->getUrl('xl-image'),
      'og_image' => $this->getUrl()
    ];
    }
}
