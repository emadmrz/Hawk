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

}
