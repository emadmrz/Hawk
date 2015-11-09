<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='groups';

    protected $fillable=['user_id','name','banner','image'];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function problems()
    {
        return $this->morphMany('App\Problem', 'parentable');
    }

    public function posts()
    {
        return $this->morphMany('App\Post', 'parentable');
    }

    /*public function parents()
    {
        return $this->morphMany('App\Post', 'parentable');
    }*/
}
