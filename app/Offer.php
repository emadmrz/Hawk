<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Offer extends Model
{
    protected $table = 'offers';
    protected $fillable = ['status', 'paid', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }
    public function coupon_gallery(){
        return $this->hasMany('App\CouponGallery');
    }
    public function coupons(){
        return $this->hasMany('App\Coupon');
    }
    public function getShamsiExpiredAtAttribute(){
        $created_at=$this->attributes['created_at'];
        $expired_at=Carbon::parse($created_at)->addMonth(1);
        return jDate::forge($expired_at)->format("Y/m/d");

    }
    public function scopeValid($query){
        $created_at=$this->created_at;
        $expired_at=Carbon::parse($created_at)->subMonth(1);
        $query->where('created_at','>=',$expired_at);
    }

}
