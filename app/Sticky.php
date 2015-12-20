<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticky extends Model
{
    protected $table = 'stickies';
    protected $fillable = ['user_id', 'profile_id', 'position_left', 'position_top', 'body'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function profile(){
        return $this->belongsTo('App\User', 'profile_id', 'id');
    }


}
