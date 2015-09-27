<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_id', 'body', 'status', 'commentable_id', 'commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getShamsiHumanCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->ago();
    }
}
