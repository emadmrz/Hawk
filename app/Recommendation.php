<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Recommendation extends Model
{
    protected  $table = 'recommendations';
    protected  $fillable = ['user_id', 'skill_id', 'text', 'status'];

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
