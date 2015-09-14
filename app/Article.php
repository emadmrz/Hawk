<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

class Article extends Model
{
    protected $table ='articles';
    protected $fillable=['user_id', 'title', 'content', 'keywords', 'num_like', 'num_comment', 'num_visit', 'banner', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function getThumbnailAttribute(){
        if(empty($this->attributes['banner'])){
            return 'empty.png';
        }else{
            return $this->attributes['banner'];
        }
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('%A %d %B %Y ');
    }
}
