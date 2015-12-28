<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Group extends Model
{
    protected $table='groups';

    protected $fillable=['user_id','name','banner','image','active'];

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

    public function getAvatarAttribute(){
        if(empty($this->attributes['image'])){
            return 'group-icon.jpg';
        }else{
            return $this->attributes['image'];
        }
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function message()
    {
        return $this->morphMany('App\Message', 'parentable');
    }
}
