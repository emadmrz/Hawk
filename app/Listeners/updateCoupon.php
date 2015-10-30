<?php

namespace App\Listeners;

use App\Events\couponPurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class updateCoupon
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
     * @param  couponPurchased  $event
     * @return void
     */
    public function handle(couponPurchased $event)
    {
        $payment = $event->payment;
        $couponUser = $payment->itemable;
        $coupon = $couponUser->coupon;
        $payment->update(['status'=>1]);
        $couponUser->update([
            'status'=>1,
            'real_amount'=>$coupon->real_amount,
            'pay_amount'=>$coupon->pay_amount,
            'tracking_code'=>str_random('8'),
            'legal_code'=>rand(1000,9999)
        ]);
        $coupon->sold();
    }
}
