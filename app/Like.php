<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = ['user_id', 'value', 'likeable_id', 'likeable_type'];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
