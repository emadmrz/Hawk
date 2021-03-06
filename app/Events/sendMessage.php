<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class sendMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data;
    public $holder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data, $holder)
    {
        $this->data = $data;
        $this->holder = $holder;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
//        return ['user.'.$this->user->id];
        return ['user.'.$this->holder];
    }
}
