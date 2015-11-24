<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 24/11/2015
 * Time: 07:06 PM
 */

namespace App\Repositories;


use App\MessageUser;
use Illuminate\Support\Facades\Auth;

class ChatRepository {

    public $latest;

    public function history($holder){
        $user = Auth::user();
        $history = MessageUser::where('user_id', $user->id )
            ->where('parentable_type', 'App\User')
            ->where('parentable_id', $holder)
            ->orWhere(function($query) use ($user, $holder){
                $query->where('parentable_type', 'App\User')
                    ->where('parentable_id', $user->id)
                    ->where('user_id', $holder );
            });
        return $history->latest()->get();
    }

    public function historyCollection($holder){
        $user = Auth::user();
        $history = MessageUser::where('user_id', $user->id )
            ->where('parentable_type', 'App\User')
            ->where('parentable_id', $holder)
            ->orWhere(function($query) use ($user, $holder){
                $query->where('parentable_type', 'App\User')
                    ->where('parentable_id', $user->id)
                    ->where('user_id', $holder );
            });
        return $history;
    }

    public function latest($holder){
        $history = $this->history($holder);
        if(count($history)){
            $this->latest = $history->first();
        }else{
            $this->latest =  null;
        }
    }

    public function latestMessage(){
        if($this->latest != null){
            return $this->latest->message->message;
        }else{
            return ' ';
        }
    }

    public function latestCreatedAt(){
        if($this->latest != null){
            return $this->latest->message->shamsi_human_created_at;
        }else{
            return ' ';
        }
    }

}