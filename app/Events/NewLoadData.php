<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NewLoadData implements ShouldBroadcast
{
    private $loadAnalysisResults;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct($loadAnalysisResults)
    {
        $this->loadAnalysisResults = $loadAnalysisResults;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('loadData'),
        ];
    }
    public function broadcastWith(): array
    {
        return [
            'data' => $this->loadAnalysisResults,
        ];
    }
}