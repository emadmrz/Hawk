<?php

namespace App\Http\Controllers\Api;

use App\Repositories\FriendRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function num(FriendRepository $friendRepository){
        return[
            'friend_request'=>$friendRepository->requestsToMe()->count()
        ];
    }
}
