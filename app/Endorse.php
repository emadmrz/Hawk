<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

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

    public function getShamsiHumanCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->ago();
    }
}
