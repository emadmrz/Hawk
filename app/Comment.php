<?php

namespace App;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Comment extends Model
{
    use LikeRepository;

    protected $table = 'comments';
    protected $fillable = ['user_id', 'body', 'num_like', 'num_dislike', 'status', 'commentable_id', 'commentable_type'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

    public function getShamsiHumanCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->ago();
    }
}
