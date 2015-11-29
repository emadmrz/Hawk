<?php

namespace App\Events;

use App\Events\Event;
use App\Payment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class profitPurchased extends Event
{
    use SerializesModels;

    public $payment;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment=$payment;
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
