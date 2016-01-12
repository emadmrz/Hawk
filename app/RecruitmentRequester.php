<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class RecruitmentRequester extends Model
{
    protected $table='recruitment_requesters';

    protected $fillable=['phone_number','recruitment_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function recruitment(){
        return $this->belongsTo('App\Recruitment');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function answers(){
        return RecruitmentAnswer::where('user_id',$this->attributes['user_id'])->where('recruitment_id',$this->attributes['recruitment_id'])->get();
    }
}
