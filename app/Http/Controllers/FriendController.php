<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Repositories\FriendRepository;
use App\Stream;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        $friend = Friend::find($request->friendship_id);
        $friend->update(['status'=>1]);
        $this->stream($friend);
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>0,
            'msg'=> '',
            'returns'=>['status'=>1]
        ];
    }

    private function stream($friendship){
        $friendRepository = new FriendRepository();
        $friends = $friendRepository->myFriends();
        $user = Auth::user();
        foreach($friends as $friend){
            Stream::create([
                'user_id'=>$friend->friend_info->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $friendship->id,
                'contentable_type'=> 'App\Friend',
                'parentable_id'=>$user->id,
                'parentable_type'=>'App\User',
                'is_see'=>0
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'edge_ranke'=> 0,
            'contentable_id'=> $friendship->id,
            'contentable_type'=> 'App\Friend',
            'parentable_id'=>$user->id,
            'parentable_type'=>'App\User',
            'is_see'=>1
        ]);
    }
}
