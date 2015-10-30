<?php

namespace App\Http\Controllers;

use App\CouponGallery;
use App\Offer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;

class OfferController extends Controller
{
    public function create(Request $request){
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required|image',
            'expired_at'=>'required|date'
        ]);
        $user=Auth::user();
        // wildcard is needed
        $offer=$user->offers()->where('status','=',1)->firstOrFail();
        $input=$request->all();
        $image=$input['image'];
        $imageName=$user->id.str_random(20).".".$image->getClientOriginalExtension();
        $image->move(public_path().'/img/files/'.$user->id,$imageName);
        $user->coupon_gallery()->create([
            'offer_id'=>$offer->id,
            'title'=>$input['title'],
            'description'=>$input['description'],
            'expired_at'=>$input['expired_at'],
            'image'=>$user->id."/".$imageName
        ]);
        Flash::success(trans('messages.offerCreated'));
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add
        return redirect()->back();

    }
    public function edit(Offer $offer){
        //check if the offer is valid or not
        if(!$offer->valid()){
            Flash::error(trans('messages.offerExpired'));
            return redirect(route('profile.management.addon.offer'));
        }
        $user=Auth::user();
        $specialOffers=$offer->coupon_gallery()->valid()->lists('title','id');
        $coupons=$offer->coupons()->get();
        return view('store.offer.edit',compact('user','offer','specialOffers','coupons'))->with(['title'=>'ویرایش پینهاد ویژه']);
    }
}