<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class CouponUser extends Model
{
    protected $table='coupon_user';
    protected $fillable=['user_id','coupon_id','pay_amount','real_amount','status','tracking_code','legal_code'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function Coupon(){
        return $this->belongsTo('App\Coupon');
    }
    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }
    public function getShamsiUpdatedAtAttribute(){
        return jDate::forge($this->attributes['updated_at'])->format('Y/m/d');
    }
    public function getExpiredAtAttribute(){
        $coupon=$this->coupon()->firstOrFail();
        $service=$coupon->coupon_gallery()->firstOrFail();
        $expired_at=$service->expired_at;
        return jDate::forge($expired_at)->format('Y/m/d');
    }
}
