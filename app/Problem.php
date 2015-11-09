<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Problem extends Model
{
    protected $table='problems';
    protected $fillable=[
        'user_id','parentable_id','parentable_type','image','content','num_like','num_comment','comment_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function parentable(){
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * Created By Dara on 11/9/2015
     * report morph relation
     */
    public function reports(){
        return $this->morphMany('App\Report','itemable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['create_at'])->format('Y/m/d');
    }

    public function getShamsiHumanCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->ago();
    }

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

}
