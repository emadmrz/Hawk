<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CouponGallery extends Model
{
    protected $table='coupon_gallery';
    protected $fillable=['image','title','description','user_id','offer_id','expired_at'];
    public function setExpiredAtAttribute($date){
        $this->attributes['expired_at']=Carbon::parse($date);
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
}
