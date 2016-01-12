<?php

namespace App\Events;

use App\Events\Event;
use App\Recruitment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class recruitmentConfirmed extends Event
{
    use SerializesModels;
    public $recruitment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Recruitment $recruitment)
    {
        $this->recruitment=$recruitment;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
