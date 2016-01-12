<?php

namespace App\Listeners;

use App\Addon;
use App\Events\recruitmentPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class activeRecruitment
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
    public function handle(recruitmentPurchased $event)
    {
        $user=Auth::user();
        $payment=$event->payment;
        $recruitment=$payment->itemable;
        $payment->update(['status'=>1]);
        $recruitment->update(['status'=>1]);
        Addon::recruitment()->first()->buy();
    }
}
