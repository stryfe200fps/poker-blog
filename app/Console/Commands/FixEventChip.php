<?php

namespace App\Console\Commands;

use App\Models\EventChip;
use App\Models\EventReport;
use Illuminate\Console\Command;

class FixEventChip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'eventchip:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $events = EventChip::all();
        foreach ($events as $chip) {
            $chip->date_published = $chip->created_at;
            $chip->save();

            $eventReport = EventReport::find($chip->event_report_id);
            if ($eventReport?->day_id !== null && $eventReport?->day_id !== 0) {
                $chip->day_id = $eventReport->day_id;
                $chip->save();
            }
        }

        echo 'done!!!!';

        return Command::SUCCESS;
    }
}
