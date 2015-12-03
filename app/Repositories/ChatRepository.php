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
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\jDate;

class ChatRepository {

    public $latest; // the latest message
    public $new_count; // new messages count

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

    public function myChats(){
        $user = Auth::user();
        $send = MessageUser::where('parentable_id', $user->id)
            ->where('parentable_type', 'App\User')
            ->where('user_id', '!=', $user->id)
            ->groupBy('user_id')->get();
        $receive = MessageUser::where('user_id', $user->id )
            ->where('parentable_id', '!=', $user->id)
            ->where('parentable_type', 'App\User')
            ->groupBy('parentable_id')->get();
        $histories = $receive->merge($send);
        $histories = $histories->each(function($history, $key) use ($user) {
            if($history->user_id == $user->id){
                $history->friend_info = $history->parentable;
            }elseif($history->parentable_id == $user->id){
                $history->friend_info = $history->user;
            }
            $this->latest($history->friend_info->id);
            $history->latestMessage = $this->latestMessage();
            $history->latestCreatedAt = $this->latestCreatedAt();
            $history->latestHumanCreatedAt = jDate::forge($history->latestCreatedAt)->ago();
            $history->newMessagesCount = $this->newMessagesCount();
        })->sortByDesc('latestCreatedAt');
        $histories = $histories->groupBy(function ($item, $key) {
            return $item->friend_info->id;
        });
        return $histories;
    }

    public function latest($holder){
        $history = $this->history($holder);
        if(count($history)){
            $this->latest = $history->first();
            $this->new_count = $history->where('status',0) //not readed messages
                ->where('parentable_type', 'App\User') //from a user
                ->where('parentable_id', '!=', Auth::user()->id) //I didn't send it
                ->count();
        }else{
            $this->latest =  null;
            $this->new_count = null;
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
            return $this->latest->message->created_at;
        }else{
            return ' ';
        }
    }

    public function newMessagesCount(){
        if($this->new_count != null){
            return $this->new_count;
        }else{
            return 0;
        }
    }

}