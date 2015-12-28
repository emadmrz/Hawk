<?php

namespace App\Http\Controllers;

use App\Category;
use App\Parameter;
use App\Poll;
use App\Province;
use App\Stream;
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

    public function select(Poll $poll){
        $provinces = Province::where('parent_id', null)->lists('name', 'id');
        $provinces[0] = 'اهمیتی ندارد';
        $cities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $cities[0] = 'اهمیتی ندارد';
        $firstSkillCat = Category::where('parent_id', null)->lists('name', 'id');
        $firstSkillCat[0] = 'اهمیتی ندارد';
        $secondSkillCat = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $secondSkillCat[0] = 'اهمیتی ندارد';


        return view('store.poll.publish')->with([
            'title'=>'دریافت کنندگان نشر سنجی',
            'provinces' => $provinces,
            'cities' => $cities,
            'firstSkillCat' => $firstSkillCat,
            'secondSkillCat' => $secondSkillCat,
            'poll'=>$poll,
            'hasFilters'=>true
        ]);
    }

    public function search(Poll $poll, Request $request, SearchController $searchController){
        $results = $searchController->userProccess($request);
        $hasFilters = false;
        return view('store.poll.publish', compact('results', 'poll', 'hasFilters'))->with(['title'=>'انتخاب دریافت کنندگان نظر سنجی']);
    }

    public function publish(Poll $poll, Request $request){
        $poll->update(['status'=>2]);
        $this->stream($request->input('receiver'), $poll);
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

    private function stream($receivers, $poll){
        foreach($receivers as $receiver){
            if($poll->user_id != $receiver){
                Stream::create([
                    'user_id'=>$receiver,
                    'edge_ranke'=> 0,
                    'contentable_id'=> $poll->id,
                    'contentable_type'=> 'App\Poll',
                    'parentable_id'=>$poll->user_id,
                    'parentable_type'=>'App\User',
                    'is_see'=>0
                ]);
            }
        }
        Stream::create([
            'user_id'=>$poll->user_id,
            'edge_ranke'=> 0,
            'contentable_id'=>$poll->id,
            'contentable_type'=> 'App\Poll',
            'parentable_id'=>$poll->user_id,
            'parentable_type'=>'App\User',
            'is_see' => 1
        ]);
    }

    /**
     * Created By Dara on 25/12/2015
     * user-poll admin control
     */
    public function adminIndex(User $user){
        $polls=$user->polls()->paginate(20);
        return view('admin.poll.index',compact('polls','user'))->with(['title'=>'User Poll Management']);
    }

    public function adminChange(User $user,Poll $poll){
        if($poll->active==0){ //the poll is already disabled
            $poll->update(['active'=>1]);
            Flash::success(trans('admin/messages.pollActivate'));
        }elseif($poll->active==1){ //the poll is already enabled
            $poll->update(['active'=>0]);
            Flash::success(trans('admin/messages.pollBan'));
        }
        return redirect()->back();
    }

}
