<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Coupon extends Model
{
    protected $table='coupons';
    protected $fillable=['user_id','coupon_gallery_id','offer_id','title','description','real_amount','pay_amount','num'];

    public function coupon_gallery(){
        return $this->belongsTo('App\CouponGallery');
    }
    public function offer(){
        return $this->belongsTo('App\Offer');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function coupon_user(){
        return $this->hasMany('App\CouponUser');
    }
    public function getServiceAttribute(){
        $service=CouponGallery::findOrFail($this->attributes('coupon_gallery_id'));
        return $service->id;
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function sold(){
        $this->decrement('num');
    }

    /**
     * Created By Dara on 30/10/2015
     * get the expired_at diff for humans & shamsi
     */
    public function getDiffExpiredAtAttribute(){
        $coupon=CouponGallery::where('id',$this->attributes['coupon_gallery_id'])->firstOrFail();
        $expired_at=$coupon->expired_at;
        return jDate::forge($expired_at)->ago();
    }

    /**
     * Created By Dara on 30/10/2015
     * check if the coupon is valid or not by expired_at
     */
    public function  getValidAttribute(){
        $coupon=CouponGallery::where('id',$this->attributes['coupon_gallery_id'])->firstOrFail();
        $expired_at=$coupon->expired_at;
        if($expired_at>=Carbon::now()){
            return true;
        }else{
            return false;
        }
    }

    public function getValidNumAttribute(){
        if($this->num>0){
            return true;
        }else{
            return false;
        }
    }

    public function scopeValidnum($query){
        return $query->where('num','>',0);
    }
}
