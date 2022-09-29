<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventChip;
use App\Models\EventReport;
use App\Models\Player;
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

        return [
            'name' => $this->faker->name,
            'current_chips' => $this->faker->numberBetween(0, 10000),
            'chips_before' => $this->faker->numberBetween(0, 10000),
            'rank' => 1,
            'player_id' => Player::factory()->create()->id,
            'event_report_id' => EventReport::factory()->create()->id,
            'event_id' => Event::factory()->create()->id,

        ];
    }
}
