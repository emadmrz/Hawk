<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['message'];
    protected $appends = ['shamsi_human_created_at', 'shamsi_created_at'];

    public function getShamsiHumanCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->ago();
    }

    public function getShamsiCreatedAtAttribute()
    {
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d H:i:s');
    }

}
