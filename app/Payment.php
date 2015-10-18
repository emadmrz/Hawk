<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = ['user_id', 'amount', 'au', 'gateway', 'description', 'status', 'itemable_id', 'itemable_type'];

    public function itemable(){
        return $this->morphTo();
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format("Y/m/d H:i:s");
    }

}
