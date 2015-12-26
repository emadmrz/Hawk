<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Advertise extends Model
{
    protected $table = 'advertises';
    protected $fillable = ['user_id', 'type', 'package', 'status', 'expired_at','active'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getIsExpiredAttribute(){
        if($this->attributes['expired_at'] <= Carbon::now() ){
            return 1;
        }else{
            return 0;
        }
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format("Y/m/d H:i:s");
    }

    public function getShamsiExpiredAtAttribute(){
        return jDate::forge($this->attributes['expired_at'])->format("Y/m/d H:i:s");
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }


}
