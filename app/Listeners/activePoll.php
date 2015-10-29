<?php

namespace App\Listeners;

use App\Addon;
use App\Events\pollPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class activePoll
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
     * @param  pollPurchased  $event
     * @return void
     */
    public function handle(pollPurchased $event)
    {
//        $user = Auth::user();
        $payment = $event->payment;
        $poll = $payment->itemable;
        $payment->update(['status'=>1]);
        $poll->update(['status'=>1]);
        Addon::poll()->first()->buy();
    }
}
