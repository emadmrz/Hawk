<?php

namespace App\Listeners;

use App\Addon;
use App\Events\showcasePurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class activeShowcase
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
     * @param  showcasePurchased  $event
     * @return void
     */
    public function handle(showcasePurchased $event)
    {
        $payment = $event->payment;
        $showcase = $payment->itemable;
        $payment->update(['status'=>1]);
        $showcase->update(['status'=>1]);
        Addon::showcase()->first()->buy();
    }
}
