<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Corporation extends Model
{
    protected $table='corporations';

    protected $fillable=['sender_id','receiver_id','status','question_completed','skill_id'];

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function getShamsiUpdatedAtAttribute(){
        return jDate::forge($this->attributes['updated_at'])->format('Y/m/d');
    }

    public function sender(){
        return $this->belongsTo('App\User','sender_id','id');
    }

    public function receiver(){
        return $this->belongsTo('App\User','receiver_id','id');
    }

    public function skill(){
        return $this->belongsTo('App\Skill');
    }

    public function answers(){
        return $this->hasMany('App\CorporationAnswer','corporation_id','id');
    }
}
