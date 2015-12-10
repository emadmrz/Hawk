<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Rate extends Model
{
    protected $table='rates';

    protected $fillable=['parentable_id','parentable_type','rate'];

    public function parentable(){
        return $this->morphTo('parentable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }
}
