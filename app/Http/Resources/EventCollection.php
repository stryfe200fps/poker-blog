<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $status = request()->get('status') ?? '';
        $events = $this->collection;

        if (request()->has('status') && request()->get('status') !== 'all') {
            $events = $events->filter(function ($event) use ($status) {
                return  $event->status() === $status;
            });
        }

        return [
            'data' => EventResource::collection($events)
        ];
    }
}
