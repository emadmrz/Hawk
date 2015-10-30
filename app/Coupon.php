<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function sold(){
        $this->decrement('num');
    }
}
