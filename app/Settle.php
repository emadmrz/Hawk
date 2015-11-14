<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Settle extends Model
{
    protected $table='settles';

    protected $fillable=['user_id','account_number','way','account_sheba','amount','description','status','bank'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d H:i:s');
    }

}
