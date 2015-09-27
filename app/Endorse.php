<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endorse extends Model
{
    protected  $table = 'endorses';
    protected  $fillable = ['user_id', 'skill_id', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function skill(){
        return $this->belongsTo('App\Skill');
    }
}
