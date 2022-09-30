<?php

namespace App\Listeners;

use App\Events\EventReportCreated;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddTagsOnReportCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // $event->eventReport->tags()->attach($event->tagId);

                    try {
                    DB::beginTransaction();

                    $insert = DB::insert('insert into taggables (tag_id, taggable_id, taggable_type) VALUES (?, ?, ?)', [$event->tagId, $event->reportId ,'App\Models\EventReport'] );

                    DB::commit();
                }  catch (\Exception $e) {
                    DB::rollback();
                }

                // dd($insert);
        // dd($event->eventReport);
        // dd('event done');
        //
    }
}
