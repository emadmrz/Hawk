<?php

namespace App\Listeners;

use App\Addon;
use App\Events\profitPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class profitSearch
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
     * @param  profitPurchased  $event
     * @return void
     */
    public function handle(profitPurchased $event)
    {
        $user=Auth::user();
        $payment=$event->payment;
        $profit = $payment->itemable;
        $payment->update(['status'=>1]);
        $profit->update(['status'=>1]);
        Addon::profit()->first()->buy();
    }
}
