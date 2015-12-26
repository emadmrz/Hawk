<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Storage extends Model
{
    protected $table = 'storages';
    protected $fillable = ['user_id', 'capacity', 'status','active'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format("Y/m/d H:i:s");
    }
}
