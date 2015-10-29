<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Poll extends Model
{
    protected $table = 'polls';
    protected $fillable = ['user_id', 'title', 'question', 'category_id', 'scope', 'show_result', 'description', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function parameters(){
        return $this->hasMany('App\Parameter');
    }

    public function getTagsListAttribute(){
        return $this->tags->lists('id')->toArray();
    }

    public function category(){
        $this->belongsTo('App\Category');
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format("Y/m/d H:i:s");
    }

    public function votes(){
        return $this->hasMany('App\Vote');
    }

}
