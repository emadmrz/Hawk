<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Profit extends Model
{
    protected $table='profits';

    protected $fillable=['type','status','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function payment(){
        return $this->morphOne('App\Payment','itemable');
    }

    public function getShamsiExpiredAtAttribute(){
        $created_at=$this->attributes['created_at'];
        $expired_at=Carbon::parse($created_at)->addWeek(1);
        return jDate::forge($expired_at)->format("Y/m/d");

    }
}
