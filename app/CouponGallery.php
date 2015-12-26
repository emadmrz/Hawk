<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\jDateTime;

class CouponGallery extends Model
{
    protected $table='coupon_gallery';
    protected $fillable=['image','title','description','user_id','offer_id','expired_at'];

    public function setExpiredAtAttribute($date){
        $jalali = explode('/', $date);
        $this->attributes['expired_at'] = implode('-', jDateTime::toGregorian($jalali[0], $jalali[1], $jalali[2]));
    }
    public function scopeValid($query){
        $query->where('expired_at','>=',Carbon::now());
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function offer(){
        return $this->belongsTo('App\Offer');
    }
    public function coupons(){
        return $this->hasMany('App\Coupon');
    }

    /**
     * Created By Dara on 30/10/2015
     * return shamsi expired_at
     */
    public function getShamsiExpiredAtAttribute(){
        return jDate::forge($this->attributes['expired_at'])->format('Y/m/d');
    }

    public function getExpiredAtAttribute(){

        $time=Carbon::parse($this->attributes['expired_at'])->format('Y-m-d');
        return $time;
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

}
