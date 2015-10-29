<?php

namespace App\Http\Controllers;

use App\Recommendation;
use App\Repositories\FriendRepository;
use App\Skill;
use App\Stream;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
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
        $recommendation = $user->recommendations()->create($input);
        $this->stream($recommendation);
        return redirect()->back();
    }

    private function stream($recommendation){
        $authUser = Auth::user();
        $user = $recommendation->skill->user;
        $friendRepository = new FriendRepository();
        $friends = $friendRepository->friendsOf($user->id);
        foreach($friends as $friend){
            $is_see = 0;
            if($authUser->id == $friend->friend_info->id){
                $is_see = 1;
            }
            Stream::create([
                'user_id'=>$friend->friend_info->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $recommendation->id,
                'contentable_type'=> 'App\Recommendation',
                'parentable_id'=>$authUser->id,
                'parentable_type'=>'App\User',
                'is_see'=>$is_see
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'edge_ranke'=> 0,
            'contentable_id'=> $recommendation->id,
            'contentable_type'=> 'App\Recommendation',
            'parentable_id'=>$authUser->id,
            'parentable_type'=>'App\User',
            'is_see'=>0
        ]);
    }
}
