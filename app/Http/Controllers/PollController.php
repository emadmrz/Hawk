<?php

namespace App\Http\Controllers;

use App\Category;
use App\Parameter;
use App\Poll;
use App\Tag;
use App\User;
use App\Vote;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class PollController extends Controller
{
    public function edit(Poll $poll){
        $main_categories = Category::where('parent_id', null)->lists('name', 'id');
        if($poll->category_id){
            $sub_categories = Category::findOrFail($poll->category_id)->getSiblingsAndSelf()->lists('name','id');
            $all_tags = Tag::where('parent_id', $poll->category_id)->lists('name', 'id');
        }else{
            $sub_categories = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
            $all_tags = Tag::where('parent_id', key(current($sub_categories)))->lists('name', 'id');
        }
        return view('store.poll.edit', compact('poll','main_categories','sub_categories','all_tags'))->with(['title'=>'ویرایش نظر سنجی']);
    }

    public function update(Poll $poll, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'question' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msgType'=>'danger',
                'msg'=>$validator->errors()->first(),
                'returns'=>''
            ];
        }
        $input = $request->except('tags_list','_token','main_category');
        $poll->update($input);
        if(!$request->has('tags_list')){
            $poll->tags()->detach();
        }else{
            $tags_list = $request->only('tags_list');
            $poll->tags()->sync(array_flatten($tags_list));
        }
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>1,
            'msg'=>'Poll updated Successfull',
            'returns'=>''
        ];
    }

    public function parameterAdd(Poll $poll, Request $request){
        $poll->parameters()->create(['name'=>$request->input('name')]);
        return [
            'hasCallback'=>'1',
            'callback'=>'poll_parameter_add',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>$poll->parameters()->latest()->get()
        ];
    }
    public function ParameterDelete(Request $request){
        Parameter::findOrFail($request->input('id'))->delete();
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>''
        ];
    }

    public function parameterUpdate(Request $request){
        Parameter::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    public function publish(Poll $poll){
        $poll->update(['status'=>2]);
        Flash::success('poll published');
        return redirect()->route('profile.management.addon.poll');
    }

    public function preview(User $user, Poll $poll){
        $parameters = $poll->parameters()->get();
        $total_votes = $parameters->sum('num_vote');
        if($total_votes == 0) $total_votes=1;

        return view('store.poll.preview', compact('poll','user','parameters','total_votes'))->with(['title'=>$poll->name]);
    }

    public function vote(Poll $poll, Request $request){
        $user = Auth::user();
        if(Vote::where('user_id',$user->id)->where('poll_id',$poll->id)->exists()){
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msgType'=>'danger',
                'msg'=>'you have beed voted',
                'returns'=>''
            ];
        }
        Vote::create([
            'user_id'=>$user->id,
            'poll_id'=>$poll->id,
            'parameter_id'=>$request->input('vote')
        ]);
        Parameter::find($request->input('vote'))->addVote();
        $parameters = $poll->parameters()->get();
        $total_votes = $parameters->sum('num_vote');
        if($total_votes == 0) $total_votes=1;
        return [
            'hasCallback'=>1,
            'callback'=>'poll_voted',
            'hasMsg'=>1,
            'msg'=>'Voted Successfull',
            'returns'=>[
                'total_votes'=>$total_votes,
                'parameters'=>$parameters
            ]
        ];
    }
}
