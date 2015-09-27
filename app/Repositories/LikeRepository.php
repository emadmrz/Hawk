<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 23/09/2015
 * Time: 07:28 PM
 */

namespace App\Repositories;


trait LikeRepository {

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
            $this->decrement('num_like');
            $this->increment('num_dislike');
        }elseif($value == -1){
            $like->update(['value'=>1]);
            $this->decrement('num_dislike');
            $this->increment('num_like');
        }
    }
}