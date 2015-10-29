<?php

namespace App\Http\Controllers;

use App\Repositories\FriendRepository;
use App\Skill;
use App\Stream;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EndorseController extends Controller
{
    public function store(Request $request, Skill $skill){
        $user = Auth::user();
//        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
//            'author.name' => 'required',
//            'author.description' => 'required',
//        ]);
        $input = $request->all();
        $input['skill_id'] = $skill->id;
        $endorse = $user->endorses()->create($input);
        $this->stream($endorse);
        return [
            'hasCallback'=>1,
            'callback'=>'skill_endorsed',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$skill->endorses()->with('user')->get()
        ];
    }

    private function stream($endorse){
        $authUser = Auth::user();
        $friendRepository = new FriendRepository();
        $user = $endorse->skill->user;
        $friends = $friendRepository->friendsOf($user->id);
        foreach($friends as $friend){
            $is_see = 0;
            if($authUser->id == $friend->friend_info->id){
                $is_see = 1;
            }
            Stream::create([
                'user_id'=>$friend->friend_info->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $endorse->id,
                'contentable_type'=> 'App\Endorse',
                'parentable_id'=>$authUser->id,
                'parentable_type'=>'App\User',
                'is_see'=>$is_see
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'edge_ranke'=> 0,
            'contentable_id'=> $endorse->id,
            'contentable_type'=> 'App\Endorse',
            'parentable_id'=>$authUser->id,
            'parentable_type'=>'App\User',
            'is_see'=>0
        ]);
    }
}
