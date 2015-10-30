<?php

namespace App\Listeners;

use App\Events\offerPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class updateOffer
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
     * @param  offerPurchased  $event
     * @return void
     */
    public function handle(offerPurchased $event)
    {
        $user=Auth::user();
        $payment=$event->payment;
        $offer=$payment->itemable;
        $payment->update(['status'=>1]);
        $offer->update(['status'=>1]);
    }
}
