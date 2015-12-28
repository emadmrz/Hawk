<?php

namespace App\Http\Controllers;

use App\Category;
use App\Option;
use App\Province;
use App\Question;
use App\Questionnaire;
use App\Stream;
use App\Tag;
use App\Tick;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;
use Maatwebsite\Excel\Facades\Excel;

class QuestionnaireController extends Controller
{
    public function edit(Questionnaire $questionnaire){
        $main_categories = Category::where('parent_id', null)->lists('name', 'id');
        if($questionnaire->category_id){
            $sub_categories = Category::findOrFail($questionnaire->category_id)->getSiblingsAndSelf()->lists('name','id');
            $all_tags = Tag::where('parent_id', $questionnaire->category_id)->lists('name', 'id');
        }else{
            $sub_categories = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
            $all_tags = Tag::where('parent_id', key(current($sub_categories)))->lists('name', 'id');
        }
        return view('store.questionnaire.edit', compact('questionnaire','main_categories','sub_categories','all_tags'))->with(['title'=>'ویرایش پرسشنامه']);
    }

    public function update(Questionnaire $questionnaire, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return [
                'hasCallback' => 0,
                'callback' => '',
                'hasMsg' => 1,
                'msgType' => 'danger',
                'msg' => $validator->errors()->first(),
                'returns' => ''
            ];
        }
        $input = $request->except('tags_list', '_token', 'main_category');
        $questionnaire->update($input);
        if (!$request->has('tags_list')) {
            $questionnaire->tags()->detach();
        } else {
            $tags_list = $request->only('tags_list');
            $questionnaire->tags()->sync(array_flatten($tags_list));
        }
        return [
            'hasCallback' => 0,
            'callback' => '',
            'hasMsg' => 1,
            'msg' => 'Questionanire updated Successfull',
            'returns' => ''
        ];
    }

    public function questionAdd(Questionnaire $questionnaire, Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return [
                'hasCallback' => 0,
                'callback' => '',
                'hasMsg' => 1,
                'msgType' => 'danger',
                'msg' => $validator->errors()->first(),
                'returns' => ''
            ];
        }
        $options = $request->input('option');
        $question = $questionnaire->questions()->create($request->only('title'));
        foreach($options as $option){
            if(!empty($option)){
                $question->options()->create(['name'=>$option]);
            }
        }
        return [
            'hasCallback' => '1',
            'callback' => 'questionnaire_question_added',
            'hasMsg' => 1,
            'msg' => 'Question updated Successfull',
            'returns' => $question->with('options')->get()
        ];
    }

    public function questionUpdate(Request $request){
        $name = $request->input('name');
        if($name == 'title'){
            Question::findOrFail($request->input('pk'))->update(['title'=>$request->input('value')]);
        }elseif($name == 'name'){
            Option::findOrFail($request->input('pk'))->update(['name'=>$request->input('value')]);
        }
    }

    public function questionDelete(Request $request){
        Question::findOrFail($request->input('id'))->delete();
    }

    public function preview(User $user, Questionnaire $questionnaire){
        return view('store.questionnaire.preview',compact('questionnaire','user'))->with(['title'=>$questionnaire->title]);
    }

    public function tick(Questionnaire $questionnaire, Request $request){
        $ticks = $request->input('tick');
        $user = Auth::user();
        foreach($ticks as $key=>$tick){
            if(!empty($tick)){
                Tick::create([
                    'user_id'=>$user->id,
                    'questionnaire_id'=>$questionnaire->id,
                    'question_id'=>$key,
                    'option_id'=>$tick
                ]);
                Option::findOrFail($tick)->addTick();
            }
        }
        Flash::success('questionnaire sent successfully');
        return redirect(route('home.questionnaire.preview',['profile'=>$user->id, 'questionnaire'=>$questionnaire->id]));
    }

    public function result(User $user, Questionnaire $questionnaire){
        $total_ticks = [];
        foreach($questionnaire->questions()->get() as $question){
            $total_ticks[$question->id]=0;
            foreach($question->options()->get() as $option){
                $total_ticks[$question->id] += $option->num_vote;
            }
            if($total_ticks[$question->id] == 0){ $total_ticks[$question->id]=1;}
        }
        return view('store.questionnaire.result',compact('questionnaire','total_ticks','user'))->with(['title'=>$questionnaire->title]);
    }

    public function export(Questionnaire $questionnaire){
        $total_ticks = [];
        foreach($questionnaire->questions()->get() as $question){
            $total_ticks[$question->id]=0;
            foreach($question->options()->get() as $option){
                $total_ticks[$question->id] += $option->num_vote;
            }
            if($total_ticks[$question->id] == 0){ $total_ticks[$question->id]=1;}
        }
        Excel::create($questionnaire->title, function($excel) use ($questionnaire, $total_ticks) {
            // Set the title
            $excel->setTitle($questionnaire->title);

            // Chain the setters
            $excel->setCreator($questionnaire->user->username)
                ->setCompany('Skillema');

            // Call them separately
            $excel->setDescription($questionnaire->description);

            $excel->sheet('result', function($sheet) use ($questionnaire, $total_ticks) {
                $sheet->loadView('excel.questionnaire',compact('questionnaire', 'total_ticks'));
            });

        })->export('xlsx');
    }

    public function select(Questionnaire $questionnaire){
        $provinces = Province::where('parent_id', null)->lists('name', 'id');
        $provinces[0] = 'اهمیتی ندارد';
        $cities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $cities[0] = 'اهمیتی ندارد';
        $firstSkillCat = Category::where('parent_id', null)->lists('name', 'id');
        $firstSkillCat[0] = 'اهمیتی ندارد';
        $secondSkillCat = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $secondSkillCat[0] = 'اهمیتی ندارد';


        return view('store.questionnaire.publish')->with([
            'title'=>'دریافت کنندگان پرسشنامه',
            'provinces' => $provinces,
            'cities' => $cities,
            'firstSkillCat' => $firstSkillCat,
            'secondSkillCat' => $secondSkillCat,
            'questionnaire'=>$questionnaire,
            'hasFilters'=>true
        ]);
    }

    public function search(Questionnaire $questionnaire, Request $request, SearchController $searchController){
        $results = $searchController->userProccess($request);
        $hasFilters = false;
        return view('store.questionnaire.publish', compact('results', 'questionnaire', 'hasFilters'))->with(['title'=>'انتخاب دریافت کنندگان پرسشنامه']);
    }

    public function publish(Questionnaire $questionnaire, Request $request){
        $questionnaire->update(['status'=>2]);
        $this->stream($request->input('receiver'), $questionnaire);
        Flash::success('questionnaire published');
        return redirect()->route('profile.management.addon.questionnaire');
    }

    private function stream($receivers, $questionnaire){
        foreach($receivers as $receiver){
            if($questionnaire->user_id != $receiver){
                Stream::create([
                    'user_id'=>$receiver,
                    'edge_ranke'=> 0,
                    'contentable_id'=> $questionnaire->id,
                    'contentable_type'=> 'App\Questionnaire',
                    'parentable_id'=>$questionnaire->user_id,
                    'parentable_type'=>'App\User',
                    'is_see'=>0
                ]);
            }
        }
        Stream::create([
            'user_id'=>$questionnaire->user_id,
            'edge_ranke'=> 0,
            'contentable_id'=>$questionnaire->id,
            'contentable_type'=> 'App\Questionnaire',
            'parentable_id'=>$questionnaire->user_id,
            'parentable_type'=>'App\User',
            'is_see' => 1
        ]);
    }

    /**
     * Created By Dara on 23/12/2015
     * addon (questionnaire) admin control
     */
    public function adminIndex(User $user){
        $questionnaires=$user->questionnaires()->latest()->paginate(20);
        return view('admin.questionnaire.index',compact('user','questionnaires'))->with(['title'=>'Questionnaire Addon Management']);
    }

    public function adminChange(User $user,Questionnaire $questionnaire){
        if($questionnaire->active==0){ //the questionnaire is already disabled
            $questionnaire->update(['active'=>1]);
            Flash::success(trans('admin/messages.questionnaireActivate'));
        }elseif($questionnaire->active==1){ //the questionnaire is already enabled
            $questionnaire->update(['active'=>0]);
            Flash::success(trans('admin/messages.questionnaireBan'));
        }
        return redirect()->back();
    }
}
