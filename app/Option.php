<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'options';
    protected $fillable = ['question_id', 'name', 'num_vote'];

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function ticks(){
        return $this->hasMany('App\Tick');
    }

    public function addTick(){
        $this->increment('num_vote');
    }

    public function removeTick(){
        $this->decrement('num_vote');
    }
}
