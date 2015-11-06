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
    public function create(Offer $offer,Request $request){
        if ($request->user()->cannot('edit-offer', [$offer])) {
            abort(403);
        }
        $this->validate($request,[
            'title'=>'required',
            'image'=>'required|image',
            'expired_at'=>'required'
        ]);
        $user=Auth::user();
        // wildcard is needed
        $offer=$user->offers()->where('id',$offer->id)->where('status',1)->valid()->firstOrFail();
        $input=$request->all();
        $data = $request->input('cropper_json');
        $data = json_decode(stripslashes($data));
        $image=$input['image'];
        $imageName=$user->id.str_random(20).".".$image->getClientOriginalExtension();
        $image->move(public_path().'/img/files/'.$user->id,$imageName);
        $src = public_path() . '/img/files/'.$user->id.'/'.$imageName;

        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y) );
        $img->resize(851, 360);
        $img->save($src, 90);

        $service=$user->coupon_gallery()->create([
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

    /**
     * Created By Dara on 30/10/2015
     * show all the services for the user
     */
    public function showServices(){
        $user=Auth::user();
        $services=$user->coupon_gallery()->get();
        return view('store.offer.showServices',compact('user','services'))->with(['title'=>'مدیریت خدمت']);
    }

    /**
     * Created By Dara on 30/10/2015
     * edit the service
     */
    public function editService(CouponGallery $service){
        $user=Auth::user();
        return view('store.offer.editService',compact('user','service'))->with(['title'=>'ویرایش خدمت']);
    }
}