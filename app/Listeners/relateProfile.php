<?php

namespace App\Listeners;

use App\Addon;
use App\Events\relaterPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class relateProfile
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
     * @param  storagePurchased  $event
     * @return void
     */
    public function handle(relaterPurchased $event)
    {
        $user = Auth::user();
        $payment = $event->payment;
        $relater = $payment->itemable;
        $payment->update(['status'=>1]);
        $relater->update(['status'=>1]);
        Addon::relater()->first()->buy();
    }
}
