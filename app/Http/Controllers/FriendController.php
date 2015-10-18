<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Repositories\FriendRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    public function request(Request $request, FriendRepository $friendRepository){
        $friend = User::findOrFail($request->input('profile'));
        $exist = $friendRepository->isFriend($friend->id);
        if(!$exist){
            $friendRepository->makeFriend($friend);
            return [
                'hasCallback'=>'1',
                'callback'=>'friendRequest',
                'hasMsg'=>'1',
                'msg'=>trans('profile.friendRequestSent'),
                'returns'=>['status'=>2]
            ];
        }else{
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>'1',
                'msgType'=>'info',
                'msg'=>trans('profile.friendRequestDuplicated'),
                'returns'=>''
            ];
        }

    }

    public function index(FriendRepository $friendRepository){
        return view('profile.friend')
            ->nest('content', 'profile.partials.friends', compact('friendRepository'))
            ->with(['title'=>'friends']);
    }

    public function requestsList(FriendRepository $friendRepository){
        return view('partials.friendRequestList', compact('friendRepository'));
    }

    public function requests(FriendRepository $friendRepository){
        return view('profile.friend')
            ->nest('content', 'profile.partials.newFriends', compact('friendRepository'))
            ->with(['title'=>'requests']);
    }

    public function pending(FriendRepository $friendRepository){
        return view('profile.friend')
            ->nest('content', 'profile.partials.myFriendRequest', compact('friendRepository'))
            ->with(['title'=>'requests']);
    }

    public function unFriend(Request $request){
        Friend::find($request->friendship_id)->delete();
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>0,
            'msg'=> '',
            'returns'=>['status'=>1]
        ];
    }

    public function accept(Request $request){
        Friend::find($request->friendship_id)->update(['status'=>1]);
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>0,
            'msg'=> '',
            'returns'=>['status'=>1]
        ];
    }
}
