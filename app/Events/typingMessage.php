<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class typingMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $typist;
    public $holder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($holder)
    {
        $this->typist = Auth::user();
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
