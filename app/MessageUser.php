<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Facades\jDate;

class MessageUser extends Model
{
    protected $table = 'message_user';
    protected $fillable = ['user_id', 'message_id', 'parentable_id', 'parentable_type', 'status'];

    public function parentable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function message(){
        return $this->belongsTo('App\Message');
    }

    public function getShamsiCreatedAtAttribute()
    {
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d H:i:s');
    }

    public function getShamsiHumanCreatedAtAttribute()
    {
        return jDate::forge($this->attributes['created_at'])->ago();
    }


}
