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
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Laracasts\Flash\Flash;
use Morilog\Jalali\jDate;

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
        $coupon_user = CouponUser::whereIn('coupon_id', $coupons)->where('status', '!=', 0)->get();
        return view('store.offer.soldCouponsPreview',compact('user','coupon_user'))->with(['title'=>'مدیریت کوپن های خریداری شده']);
    }

    public function create(Request $request, Offer $offer)
    {
        if ($request->user()->cannot('edit-offer', [$offer])) {
            abort(403);
        }
        $this->validate($request, [
            'offer' => 'required|integer',
            'num' => 'required|integer|min:1',
            'title' => 'required|min:3',
            'description' => 'required|min:3',
            'real_amount' => 'required|integer',
            'pay_amount' => 'required|integer'
        ]);
        $user = Auth::user();
        $input = $request->all();
        //check if the service is valid or not
        $service=CouponGallery::where('id',$input['offer'])->firstOrFail();
        if($service->expired_at<Carbon::now()){
            abort(403);
        }
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
        $this->validate($request, [
            'payment_gate' => 'required|in:mellat,in-place',
        ]);
        if($coupon->valid && $coupon->valid_num){
            //the coupon is valid and ready to be bought
            $user = Auth::user();
            $gate = $request->input('payment_gate');
            if($gate == 'in-place'){
                $couponUser = $user->coupon_user()->create([
                    'coupon_id' => $coupon->id,
                    'real_amount'=>$coupon->real_amount,
                    'pay_amount'=>$coupon->pay_amount,
                    'tracking_code'=>str_random('8'),
                    'legal_code'=>rand(1000,9999),
                    'status'=>1
                ]);
                Flash::success('coupon added successfully');
                return redirect(route('profile.coupon.preview', $couponUser->id));
            }
            $price = $coupon->pay_amount;
            $description = "خرید کوپن";
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
        }else{
            Flash::error(trans('messages.couponExpired'));
            return redirect()->back();
        }
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
        return view('store.offer.coupon', compact('couponUser'));
    }

    public function sold(CouponUser $couponUser,Request $request)
    {
        $user = Auth::user();
        $input = $request->all();
        $trackingCode = $input['tracking_code'];
        $legalCode = $input['legal_code'];
        //check the information of the coupon
        if($couponUser->tracking_code==$trackingCode && $couponUser->legal_code==$legalCode){
            //the coupon info is correct
            //check if him/her is the owner of the coupon(offer)
            $coupon=$couponUser->coupon;
            if($coupon->user_id==$user->id){
                //the owner is correct and can continue
                $couponUser->update(['status'=>2]);
                //add to the credits table
                $description="خرید کوپن";
                $user->credits()->create([
                    'amount'=>$couponUser->pay_amount,
                    'description'=>$description
                ]);
                return [
                    'hasCallback'=>1,
                    'callback'=>'coupon_sold',
                    'hasMsg'=>0,
                    'msg'=>'',
                    'msgType'=>'',
                    'returns'=> [
                        'status'=>'done',
                        'date'=>jDate::forge(Carbon::now())->format('Y/m/d')
                    ]
                ];
            }else{
                //the owner is wrong
            }
        }else{
            //the coupon info is wrong
        }
    }

    public function boughtList(){
        $user=Auth::user();
        $coupons=$user->coupon_user()->get();
        return view('profile.boughtCoupons',compact('coupons','user'))->with(['title'=>'کوپن های خریداری شده']);
    }

    public function invoice(User $user, Offer $offer, Coupon $coupon){
        $gallery = $coupon->coupon_gallery;
        return view('home.couponInvoice', compact('user', 'offer', 'coupon', 'gallery'))->with(['title'=>'خرید کوپن']);
    }
}
