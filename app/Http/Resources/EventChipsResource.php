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
        return [
            'player' => $this->player,
            'country' => $this->player?->country,
            'rank' => $this->rank,
            'payout' => $this->payout,
            'current_chips' => $this->current_chips,
            'report_id' => $this->event_report_id,
            'previous' => $this->previousReport,
            'changes' => $changes = $this->current_chips >= $this->previousReport ?
            $this->current_chips - $this->previousReport :
            $this->previousReport - $this->current_chips,
            'symbol' => ($this->current_chips - $changes) >= $this->previousReport ? 'up' : 'down',
            'id' => $this->id,
            'created_at' => $this->created_at
        ];
    }
}
