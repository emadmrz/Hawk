<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 05/10/2015
 * Time: 05:14 PM
 */

namespace App\Repositories;


use App\Friend;
use App\User;
use Illuminate\Support\Facades\Auth;

class FriendRepository {

    private $current_user;

    public function __construct(){
        $this->current_user = Auth::user();
    }

    public function isFriend($friend){
        $exists = Friend::where(function($query) use ($friend){
            $query->where('sender_id', $this->current_user->id)->where('receiver_id', $friend);
        })->orWhere(function($query) use ($friend){
            $query->where('receiver_id', $this->current_user->id)->where('sender_id', $friend);
        })->get();
        if($exists->count() == 0){
            return 0;
        }else{
            return $exists->first()->status;
        }
    }

    public function makeFriend($friend){
        $friend = Friend::create([
            'sender_id' => $this->current_user->id,
            'receiver_id'=> $friend->id,
            'status'=>2 #pendding
        ]);
    }

    public function myTotalFriends(){
        $friends = Friend::where(function($query){
            $query->where('sender_id', $this->current_user->id);
        })->orWhere(function($query){
            $query->where('receiver_id', $this->current_user->id);
        })->get();
        $friends = $friends->each(function ($item, $key) {
            if($item->sender_id == $this->current_user->id){
                $item->friend_info = User::find($item->receiver_id);
                $item->requester = 'me';
            }elseif($item->receiver_id == $this->current_user->id){
                $item->friend_info = User::find($item->sender_id);
                $item->requester = 'other';
            }
        });
        return $friends;
    }

    public function myFriends(){
        $friends = Friend::where('status',1)->where(function($query){
            $query->where('sender_id', $this->current_user->id);
        })->orWhere(function($query){
            $query->where('receiver_id', $this->current_user->id);
        })->get();
        $friends = $friends->each(function ($item, $key) {
            if($item->sender_id == $this->current_user->id){
                $item->friend_info = User::find($item->receiver_id);
            }elseif($item->receiver_id == $this->current_user->id){
                $item->friend_info = User::find($item->sender_id);
            }
        });
        return $friends;
    }

    public function friendsOf($user){
        $friends = Friend::where(function($query) use ($user){
            $query->where('sender_id', $user);
        })->orWhere(function($query) use ($user){
            $query->where('receiver_id', $user);
        })->where('status',1)->get();
        #get friend info
        $friends = $friends->each(function ($item, $key) use ($user) {
            if($item->sender_id == $user){
                $item->friend_info = User::find($item->receiver_id);
            }elseif($item->receiver_id == $user){
                $item->friend_info = User::find($item->sender_id);
            }
        });
        return $friends;
    }

    public function requestsToMe(){
        $friends = Friend::where(function($query){
            $query->where('receiver_id', $this->current_user->id);
        })->where('status',2)->get();
        #get friend info
        $friends = $friends->each(function ($item, $key) {
            $item->friend_info = User::find($item->sender_id);
        });
        return $friends;
    }

    public function myRequestsToOthers(){
        $friends = Friend::where(function($query){
            $query->where('sender_id', $this->current_user->id);
        })->where('status',2)->get();
        #get friend info
        $friends = $friends->each(function ($item, $key) {
            $item->friend_info = User::find($item->receiver_id);
        });
        return $friends;
    }


}