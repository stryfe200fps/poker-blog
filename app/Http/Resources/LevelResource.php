<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (explode('/', $request->getPathInfo())[2] === 'events' && count(explode('/', $request->getPathInfo())) === 4) {
            $currentId = explode('/', $request->getPathInfo())[3];

            return [

                'level' => $this->name,
                'liveReports' => collect($this->live_reports->load([ 'article_author', 'liveReportPlayers.player', 'liveReportPlayers.player.country' ])->where('event_id', $currentId))->sortByDesc('date_added')->all(),
            ];
        } else {
            return [

                'level' => $this->name,
                'liveReports' => $this->live_reports->load(['liveReportPlayers'])->sortByDesc('date_added')->all(),
            ];
        }
    }
}
