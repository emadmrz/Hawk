<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Feedback extends Model
{
    protected $table='feedbacks';

    protected $fillable=['title','body','status','link'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }
}
