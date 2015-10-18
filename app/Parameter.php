<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $table = 'parameters';
    protected $fillable = ['poll_id', 'name'];

    public function poll(){
        return $this->belongsTo('App\Poll');
    }

    public function votes(){
        return $this->hasMany('App\Vote');
    }

    public function addVote(){
        $this->increment('num_vote');
    }

    public function removeVote(){
        $this->decrement('num_vote');
    }
}
