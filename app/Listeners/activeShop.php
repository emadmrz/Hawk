<?php

namespace App\Listeners;

use App\Addon;
use App\Events\shopPurchased;
use App\Repositories\FriendRepository;
use App\Stream;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class activeShop
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
     * @param  shopPurchased  $event
     * @return void
     */
    public function handle(shopPurchased $event)
    {
        $payment = $event->payment;
        $shop = $payment->itemable;
        $payment->update(['status'=>1]);
        $shop->update(['status'=>1]);
        File::makeDirectory(public_path().'/img/files/shop/'.$shop->id, 0775, true, true);
        Addon::shop()->first()->buy();
    }
}
