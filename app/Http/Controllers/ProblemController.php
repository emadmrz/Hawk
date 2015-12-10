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
            if($request->has('attachment')){
                $attachments = $request->input('attachment');
                foreach($attachments as $attachment){
                    $file=explode('::',$attachment);
                    $problem->files()->create(['user_id'=>$user->id, 'name'=>$file[0], 'real_name'=>$file[1], 'size'=>$file[2] ]);
                }
            }

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
     * Created by Emad Mirzaie on 06/11/2015.
     * attachment handle
     */
    public function attachment(Request $request){
        $user = Auth::user();
        $real_name = $request->file('attachment')->getClientOriginalName();
        $size = $request->file('attachment')->getClientSize()/(1024*1024); //calculate the file size in MB
        $imageName = str_random(20) . '.' .$request->file('attachment')->getClientOriginalExtension();
        $request->file('attachment')->move(public_path() . '/img/files/'.$user->id.'/', $imageName);
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add
        return [
            'hasCallback'=>1,
            'callback'=>'problem_attachment',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'name'=>$user->id.'/'.$imageName,
                'real_name'=>$real_name,
                'size'=>$size
            ]
        ];
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
