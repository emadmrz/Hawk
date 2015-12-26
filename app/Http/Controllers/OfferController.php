<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\CouponGallery;
use App\Offer;
use App\User;
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

    /**
     * Created By Dara on 22/12/2015
     * user-offer admin control
     */
    public function adminIndex(User $user){
        $offers=$user->offers()->paginate(20);
        return view('admin.offer.index',compact('user','offers'))->with(['title'=>'Offer Addon Management']);
    }

    public function adminChange(User $user,Offer $offer){
        if($offer->active==0){ //the offer is already disabled
            $offer->update(['active'=>1]);
            Flash::success(trans('admin/messages.offerActivate'));
        }elseif($offer->active==1){ //the offer is already enabled
            $offer->update(['active'=>0]);
            Flash::success(trans('admin/messages.offerBan'));
        }
        return redirect()->back();
    }

    public function adminServiceIndex(User $user,Offer $offer){
        $services=$offer->coupon_gallery()->paginate(20);
        return view('admin.offer.service.index',compact('user','offer','services'))->with([
           'title'=>'Offer Service Management'
        ]);
    }

    public function adminCouponIndex(User $user,Offer $offer,CouponGallery $service){
        $coupons=$service->coupons()->paginate(20);
        return view('admin.offer.service.coupon.index',compact('user','offer','service','coupons'))->with(([
            'title'=>'Offer Service Coupon Management'
        ]));
    }

    public function adminBuyerIndex(User $user,Offer $offer,CouponGallery $service,Coupon $coupon){
        $buyers=$coupon->coupon_user()->paginate(20);
        return view('admin.offer.service.coupon.buyer.index',compact('user','offer','service','coupon','buyers'))->with([
            'title'=>'Coupon Buyers Management'
        ]);
    }

}