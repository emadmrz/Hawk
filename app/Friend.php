<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Facades\jDate;

class Friend extends Model
{
    protected $table = 'friends';
    protected $fillable = ['sender_id', 'receiver_id', 'status'];

    public function getShamsiHumanCreatedAtAttribute()
    {
        return jDate::forge($this->attributes['created_at'])->ago();
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function sender(){
        return $this->belongsTo('App\User', 'sender_id', 'id');
    }

    public function receiver(){
        return $this->belongsTo('App\User', 'receiver_id', 'id');
    }

}
