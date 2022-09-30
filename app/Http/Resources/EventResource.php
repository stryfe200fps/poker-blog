<?php

namespace App\Http\Resources;

use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $levels = collect($this->live_reports->toArray())->pluck('level_id')->unique()->toArray();
        $builder = Level::where(function ($q) use ($levels) {
            $count = 0;
            foreach ($levels as $level) {
                $count++;
                $q->orWhere('id', $level);
            }
            if (! $count) {
                $q->where('id', -999);
            }
        })->orderByDesc('level', 'name');

        $dateNow = Carbon::now();

        // $start1 = Carbon::parse("2022-09-18");
        // $end1 = Carbon::parse("2022-09-13");

        $dateStart = Carbon::parse($this->date_start);
        $dateEnd = Carbon::parse($this->date_end);

        $status = '';
        if ($dateNow >= $dateStart && $dateNow <= $dateEnd) {
            $status = 'live';
        } elseif ($dateNow <= $dateStart->addDay(2)) {
            $status = 'upcoming';
        } else {
            $status = 'past';
        }

        $imgResource = [];
        foreach ($this->getMedia('event_gallery') as $media) {
            $imgResource[] = [
                'thumbnail' => $media->getUrl('main-thumb'),
                'main' => $media->getUrl(),
            ];
        }
        return [
            'id' => $this->id,
            'title' => $this->title,
            'poker_tour' => $this->poker_tournament->poker_tour->title,
            'poker_tournament' => $this->poker_tournament->title,
            'currency' => $this->poker_tournament->currency,
            'timezone' => $this->poker_tournament->timezone,
            'tournament_location' => $this->poker_tournament->country,
            'description' => $this->description,
            'image' => $this->getFirstMediaUrl('event_banner', 'banner'),
            'status' => $status,
            'gallery' => $imgResource,
            'chip_stacks' => EventChipsResource::collection($this->latest_live_report_players->unique('player_id')) ,
            'videos' => [],
            'whatsapp' => [],
            'date_start' => Carbon::parse($this->date_start)->toFormattedDateString(),
            'date_end' => Carbon::parse($this->date_end)->toFormattedDateString(),
            'levels' => LevelResource::collection($builder->get()),
            'payout' => $this->payouts->load(['player']),
        ];
    }
}
