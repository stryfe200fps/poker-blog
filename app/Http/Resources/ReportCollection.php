<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $reducedCollection = $this->collection->groupBy('level')->reduce(function ($result, $item) {
            $level = $item->first()->level;
            $result[] = [
                'level' => $level->level_value ?? '-',
                'collection' => collect($item)->map(function ($i) {
                    return new EventReportResource($i);
                }),
            ];

            return $result;
        }, collect([]))->toArray();

        return [
            'data' => $reducedCollection,
            'meta' => [
                'total' => $this->collection->count(),
            ],
        ];
    }
}
