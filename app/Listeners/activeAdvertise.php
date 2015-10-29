<?php

namespace App\Listeners;

use App\Addon;
use App\Events\advertisePurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class activeAdvertise
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
     * @param  advertisePurchased  $event
     * @return void
     */
    public function handle(advertisePurchased $event)
    {
        $payment = $event->payment;
        $advertise = $payment->itemable;
        $payment->update(['status'=>1]);
        $advertise->update(['status'=>1]);
        Addon::advertise()->first()->buy();
    }
}
