<?php

namespace App\Listeners;

use App\Addon;
use App\Events\storagePurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class increaseCapacity
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
    public function handle(storagePurchased $event)
    {
        $user = Auth::user();
        $payment = $event->payment;
        $storage = $payment->itemable;
        $payment->update(['status'=>1]);
        $storage->update(['status'=>1]);
        $user->usage->freeup($storage['capacity']);
        Addon::storage()->first()->buy();
    }
}
