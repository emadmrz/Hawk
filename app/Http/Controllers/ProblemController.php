<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Group;
use App\Problem;
use App\Repositories\GroupRepository;
use App\Stream;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProblemController extends Controller
{
    public function create(Group $group){
        $user=Auth::user();
        return view('group.newProblem',compact('group','user'))->with(['title'=>'افزودن پرسش']);
    }

    public function add(Group $group,Request $request){
        $this->validate($request, [
            'content' => 'required|min:3'
        ]);
        $user = Auth::user();
        //check if thr user is member of the group
        if ($request->user()->cannot('join-group', [$group])) {
            $problem = $user->problems()->create([
                'content' => $request->input('content'),
                'parentable_id' => $group->id,
                'parentable_type' => 'App\Group',
            ]);
            $this->groupStream($problem,$group);
        }
        return redirect(route('group.index',[$group->id]));
    }

    private function groupStream(Problem $problem,Group $group){
        $user=Auth::user();
        $groupRepository=new GroupRepository();
        $joins=$groupRepository->getAllJoinUsers($group);
        foreach($joins as $join){
            Stream::create([
                'user_id'=>$join->id,
                'contentable_id'=>$problem->id,
                'contentable_type'=>'App\Problem',
                'parentable_id'=>$group->id,
                'parentable_type'=>'App\Group',
                'is_see'=>0
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'contentable_id'=>$problem->id,
            'contentable_type'=>'App\Problem',
            'parentable_id'=>$group->id,
            'parentable_type'=>'App\Group',
            'is_see'=>1
        ]);
    }

    public function problemPreview(Group $group,Problem $problem){
        $user=Auth::user();
        return view('group.problemPreview',compact('user','group','problem'))->with(['title'=>str_limit($problem->content,20)]);
    }

    /**
     * Created By Dara on 3/11/2015
     * confirm the answer to the problem
     */
    public function confirmAnswer(Problem $problem,Comment $comment,Request $request){
        if ($request->user()->cannot('confirm-problem-answer', [$problem])) {
            abort(403);
        }
        //check if the answer has been already selected or not
        if($problem->comment_id==$comment->id){ //the answer selected before so make it default again
            $problem->update(['comment_id'=>0]);
            return [
                'hasCallback'=>1,
                'callback'=>'problem_confirm_answer',
                'hasMsg'=>0,
                'msg'=>'',
                'msgType'=>'',
                'returns'=> [
                    'status'=>'undo'
                ]
            ];
        }
        $problem->update(['comment_id'=>$comment->id]);
        return [
            'hasCallback'=>1,
            'callback'=>'problem_confirm_answer',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'status'=>'done'
            ]
        ];
    }
}
