<?php

namespace App\Events;

use App\Models\EventReport;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventReportCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public string $tekila = 'tekila';

    public EventReport $eventReport;

    public int $tagId;

    public int $reportId;

    public function __construct(EventReport $event, $tagId, $reportId)
    {
        $this->eventReport = $event;
        $this->tagId = $tagId;
        $this->reportId = $reportId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
