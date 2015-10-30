<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\CouponGallery;
use App\CouponUser;
use App\Events\couponPurchased;
use App\Offer;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Laracasts\Flash\Flash;

class CouponController extends Controller
{
    private $storeController;

    public function __construct(StoreController $storeController)
    {
        $this->storeController = $storeController;
    }

    //show all sold coupons
    public function soldCoupons()
    {
        $user = Auth::user();
        $coupons = $user->coupons()->lists('id');
        $coupon_user = CouponUser::whereIn('coupon_id', $coupons)->where('status', '=', 1)->get();
        return view('store.offer.soldCouponsPreview',compact('user','coupon_user'))->with(['title'=>'مدیریت کوپن های خریداری شده']);
    }

    public function create(Request $request, Offer $offer)
    {
        $this->validate($request, [
            'offer' => 'required|integer',
            'num' => 'required|integer',
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'real_amount' => 'required|integer',
            'pay_amount' => 'required|integer'
        ]);
        $user = Auth::user();
        $input = $request->all();
        $coupon = $user->coupons()->create([
            'offer_id' => $offer->id,
            'coupon_gallery_id' => $input['offer'],
            'title' => $input['title'],
            'description' => $input['description'],
            'real_amount' => $input['real_amount'],
            'pay_amount' => $input['pay_amount'],
            'num' => $input['num']
        ]);
        return [
            'hasCallback' => '1',
            'callback' => 'service_coupon',
            'hasMsg' => 0,
            'msg' => '',
            'returns' => $offer->coupons()->with('coupon_gallery')->get()
        ];
    }

    public function update(Request $request)
    {
        Coupon::findOrFail($request->input('pk'))->update([$request->input('name') => $request->input('value')]);
    }

    public function delete(Request $request)
    {
        Coupon::find($request->input('id'))->delete();
        return 'done';
    }

    public function buy(User $profile, Offer $offer, Coupon $coupon, Request $request)
    {
        //validate coupon
        $user = Auth::user();
        $price = $coupon->pay_amount;
        $description = "خرید کوپن";
        $gate = "mellat";
        $callback = route('home.profile.offer.coupon.callback');
        $couponUser = $user->coupon_user()->create([
            'coupon_id' => $coupon->id,
            'status' => 0
        ]);
        $order = $couponUser->payment()->create([
            'user_id' => $user->id,
            'amount' => $price,
            'gateway' => $gate,
            'description' => $description,
            'status' => 0
        ]);
        $orderId = $order->id;
        $this->storeController->pay($price, $callback, $orderId, $description, $gate);

    }

    public function callback(Request $request)
    {
        $payment = Payment::findOrfail($request->input('order_id'));
        $this->storeController->verify($request->input('au'), $payment->amount, $payment->gateway);
        if (true) {
            $payment->update(['au' => $request->input('au')]); // tracking code
            Event::fire(new couponPurchased($payment));
            Flash::success('coupon added successfully');
            return redirect(route('profile.coupon.preview', $payment->itemable_id));
        } else {
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.offer'));
        }
    }

    public function preview(CouponUser $couponUser)
    {
        return view('store.offer.couponPreview', compact('couponUser'));
    }

    public function sold(Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $id = $input['coupon_user_id'];
        $trackingCode = $input['tracking_code'];
        $legalCode = $input['legal_code'];
        $couponUser = CouponUser::where('id', $id)
            ->where('legal_code', $legalCode)
            ->where('tracking_code', $trackingCode)
            ->where('status', 1)->firstOrFail();
        $coupon = $couponUser->coupon()->firstOrFail();
        //check if the user is the owner of the coupon
        if ($coupon->user_id == $user->id) {
            $stat = true;
        } else {
            $stat = false;
        }
        if ($coupon && $stat) {
            //the coupon is found
            $service = $coupon->coupon_gallery()->firstOrFail();
            if ($service->expired_at >= Carbon::now()) {
                //the coupon is valid and ready to use
                $couponUser->update(['status', 2]);
                return [
                    'status' => 'done',
                    'msg' => 'کوپن موردنظر با موفقیت استفاده گردید'
                ];
            } else {
                //the coupon is expired and cant be used
                return [
                    'status' => 'error',
                    'msg' => 'مهلت استفاده از کوپن پایان یافته است'
                ];
            }
        } else {
            return [
                'status' => 'error',
                'msg' => 'اطلاعات کوپن صحیح نمی باشد .'
            ];
        }

    }
}
