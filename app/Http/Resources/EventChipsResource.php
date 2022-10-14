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

        return [
            'player' => $this->player,
            'country' => $this->player?->country,
            'rank' => $this->rank,
            'payout' => $this->payout,
            'current_chips' => $this->current_chips,
            'is_whatsapp' => $this->is_whatsapp,
            'report_id' => $this->event_report_id,
            'previous' => $report,
            'changes' => $changes = $this->current_chips >= $report ?
            $this->current_chips - $report :
            $report - $this->current_chips,
            'symbol' => ($this->current_chips - $changes) >= $report ? 'up' : 'down',
            'id' => $this->id,
            'created_at' => $this->created_at,
        ];
    }
}
