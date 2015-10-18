<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'votes';
    protected $fillable = ['user_id', 'poll_id', 'parameter_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function poll(){
        return $this->belongsTo('App\Poll');
    }

    public function parameter(){
        return $this->belongsTo('App\Parameter');
    }
}
