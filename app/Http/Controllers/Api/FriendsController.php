<?php

namespace App\Http\Controllers\Api;

use App\Repositories\FriendRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Morilog\Jalali\Facades\jDate;

class FriendsController extends Controller
{
    public function friends(FriendRepository $friendRepository, User $user){
        dd($user);
    }

    public function online(FriendRepository $friendRepository){
        $friends = $friendRepository->myFriends();
        $friends = $friends->each(function ($friend, $key) {
            $friend->friend_info->activity;
        });
        return $friends;
    }
}
