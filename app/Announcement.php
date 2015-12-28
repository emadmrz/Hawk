<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDateTime;
use Morilog\Jalali\jDate;

class Announcement extends Model
{
    protected $table='announcements';

    protected $fillable=['content','expired_at','active'];

    public function setExpiredAtAttribute($date){
        $jalali = explode('/', $date);
        $this->attributes['expired_at'] = implode('-', jDateTime::toGregorian($jalali[0], $jalali[1], $jalali[2]));
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function getShamsiExpiredAtAttribute(){
        return jDate::forge($this->attributes['expired_at'])->format('Y/m/d');
    }

    public function getExpiredAtAttribute(){
        return jDate::forge($this->attributes['expired_at'])->format('Y/m/d');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
