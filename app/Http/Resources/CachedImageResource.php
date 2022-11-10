<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CachedImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $urlPath = config('app.url') . "/api/images/$this->id";
        return [
            'xs_image' => $urlPath . '?w='.config('app.xs-image')[0].'&h='. config('app.xs-image')[1] ,
            'sm_image' => $urlPath . '?w='.config('app.sm-image')[0].'&h='. config('app.sm-image')[1] ,
            'md_image' => $urlPath . '?w='.config('app.md-image')[0].'&h='. config('app.md-image')[1] ,
            'lg_image' => $urlPath . '?w='.config('app.lg-image')[0].'&h='. config('app.lg-image')[1] ,
            'xl_image' => $urlPath . '?w='.config('app.xl-image')[0].'&h='. config('app.xl-image')[1] ,
            'og_image' => $urlPath
        ];
    }
}
