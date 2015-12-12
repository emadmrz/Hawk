<?php

namespace App\Http\Controllers;

use App\Events\friendRequest;
use App\Friend;
use App\Repositories\FriendRepository;
use App\Stream;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class FriendController extends Controller
{
    public function request(Request $request, FriendRepository $friendRepository){
        $friend = User::findOrFail($request->input('profile'));
        $exist = $friendRepository->isFriend($friend->id);
        if(!$exist){
            $friendRepository->makeFriend($friend);
            Event::fire(new friendRequest($friend->id, 0, $friend));
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
        return view('profile.friend',compact('friendRepository'))->with(['title'=>'friends']);
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

    /**
     * Created By Dara on 23/11/2015
     * suggest the mutual friends
     */
    public function find()
    {
        $friendRepository = new FriendRepository();

        //dd($mutuals);
        return view('profile.friend')
            ->nest('content', 'profile.partials.findMutualFriends', compact('mutuals'))
            ->with(['title' => 'یافتن دوستان جدید']);
    }

    /**
     * Created By Dara on 23/11/2015
     * accept the suggested friends the difference is the callback
     */
    public function suggestRequest(Request $request, FriendRepository $friendRepository)
    {
        $friend = User::findOrFail($request->input('profile'));
        $exist = $friendRepository->isFriend($friend->id);
        if (!$exist) {
            $friendRepository->makeFriend($friend);
            return [
                'hasCallback' => '1',
                'callback' => 'friendSuggestRequest',
                'hasMsg' => '1',
                'msg' => trans('profile.friendRequestSent'),
                'returns' => ['status' => 2]
            ];
        } else {
            return [
                'hasCallback' => 0,
                'callback' => '',
                'hasMsg' => '1',
                'msgType' => 'info',
                'msg' => trans('profile.friendRequestDuplicated'),
                'returns' => ''
            ];
        }
    }

    /**
     * Created By Dara on 23/11/2015
     * search for friends index page
     */
    public function searchIndex(FriendRepository $friendRepository)
    {
        $mutuals = $friendRepository->mutual();
        return view('profile.findFriend', compact('mutuals', 'results'))->with(['title' => 'جستجو دوستان', 'type'=>'']);
    }

    public function search(Request $request)
    {
        if ($request->has('email') && $request->has('cell_phone')) { //the email and cellphone has been entered
            $this->validate($request, [
                'email' => 'required|min:3',
                'cell_phone' => 'required|min:6',
            ]);
            //begin the search process
            $users = User::join('infos', 'users.id', "=", 'infos.user_id')
                ->where('users.email', '=', $request->input('email'))
                ->where('infos.cell_phone', '=', $request->input('cell_phone'))
                ->select('users.*')
                ->get();
            $results = $users;
        } elseif ($request->has('email') && !$request->has('cell_phone')) { // the email has been entered only
            $this->validate($request, [
                'email' => 'required|min:3'
            ]);
            $users = User::where('email', '=', $request->input('email'))
                ->select('users.*')
                ->get();
            $results = $users;
        } elseif (!$request->has('email') && $request->has('cell_phone')) {
            $this->validate($request, [
                'cell_phone' => 'required|min:6'
            ]);
            $users = User::join('infos', 'users.id', "=", 'infos.user_id')
                ->where('infos.cell_phone', '=', $request->input('cell_phone'))
                ->select('users.*')
                ->get();
            $results = $users;
        } else {
            $this->validate($request, [
                'email' => 'required',
                'cell_phone' => 'required'
            ]);
        }
        return view('profile.findFriend',compact('results'))->with(['title' => 'نتایج جستجو', 'type'=>'search']);

    }
}
