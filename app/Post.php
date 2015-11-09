<?php

namespace App;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;

class Post extends Model
{
    use LikeRepository;

    protected $tabel = 'posts';
    protected $fillable = ['user_id', 'content', 'location', 'image', 'num_like', 'num_comment','parentable_id','parentable_type'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('%A %d %B %Y ');
    }

    public function getShamsiHumanCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->ago();
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function parentable()
    {
        return $this->morphTo();
    }

    /**
     * Created By Dara on 11/9/2015
     * report morph relation
     */
    public function reports(){
        return $this->morphMany('App\Report','itemable');
    }
}
