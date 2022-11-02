<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Player;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventChipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventChip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //  $table->id();
//             $table->string('name');
//             $table->foreignId('player_id');
//             $table->foreignId('event_id')->nullable();
//             $table->foreignId('event_report_id');
//             $table->integer('current_chips')->default(0);
//             $table->float('payout', 15, 2)->default(0);
//             $table->integer('rank')->default(0);
//             $table->integer('chips_before')->default(0);

// dd(EventReport::factory()->create());

        return [
            'player_id' => Player::factory()->create()->id,
            'event_report_id' => EventReport::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,
            'current_chips' => 2000,
            'day_id' => Day::factory()->create()->id,
            'published_date' => Carbon::now()
        ];
    }
}
