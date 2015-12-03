<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class seenMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public  $holder;
    public  $owner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($holder)
    {
        $this->owner = Auth::user()->id;
        $this->holder = $holder;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.'.$this->holder];
    }
}
