<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relater extends Model
{
    protected $table='relaters';

    protected $fillable=['type','status','user_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function payment(){
        return $this->morphOne('App\Payment','itemable');
    }
}
