<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Share extends Model
{
    protected $table = 'shares';
    protected $fillable = ['user_id', 'shareable_id', 'shareable_type', 'num_visit', 'social'];

    public function shareable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }
}
