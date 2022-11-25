<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventChipsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $report = $this->previousReport;

        // $this->load('player');
        return [
            'player' => new PlayerResource($this->player),
            'rank' => $this->rank,
            'current_chips' => $this->current_chips,
            'is_whatsapp' => $this->is_whatsapp,
            'previous' => $report,
            'date' =>  $this->published_date->diffForHumans(),
            'changes' => $changes = $this->current_chips >= $report ?
            $this->current_chips - $report :
            $report - $this->current_chips,
            'symbol' => ($this->current_chips - $changes) >= $report ? 'up' : 'down',
        ];
    }
}
