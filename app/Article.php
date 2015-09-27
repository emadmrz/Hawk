<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
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

    public function getShamsiUpdatedAtAttribute(){
        return jDate::forge($this->attributes['updated_at'])->format('%A %d %B %Y ');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

    public function visits(){
        return $this->morphMany('App\Visit', 'visitable');
    }

    public function like($user_id){
        $this->likes()->create(['user_id'=>$user_id, 'value'=>1]);
        $this->increment('num_like');
    }

    public function dislike($user_id){
        $this->likes()->create(['user_id'=>$user_id, 'value'=>-1]);
        $this->increment('num_dislike');
    }

    public function likedany($user_id){
        $like = $this->likes()->where('user_id',$user_id);
        if($like->count() > 0){
            return $like->first()->value;
        }else{
            return 0;
        }
    }

    public function liked($user_id){
        return (bool) $this->likes()
            ->where('user_id',$user_id)
            ->where('value',1)
            ->count();
    }

    public function disliked($user_id){
        return (bool) $this->likes()
            ->where('user_id',$user_id)
            ->where('value',-1)
            ->count();
    }

    public function unlike($user_id){
        $like = $this->likes()->where('user_id',$user_id);
        $value = $like->first()->value;
        if($value == 1){
            $this->decrement('num_like');
        }elseif($value==-1){
            $this->decrement('num_dislike');
        }
        $like->delete();
    }


    public function revertlike($user_id){
        $like = $this->likes()->where('user_id',$user_id);
        $value = $like->first()->value;
        if($value == 1){
            $like->update(['value'=>-1]);
        }elseif($value == -1){
            $like->update(['value'=>1]);
        }
    }

    public function visit(){
        $user = Auth::user();
        $this->visits()->create(['user_id'=>$user->id]);
        $this->increment('num_visit');
    }



}
