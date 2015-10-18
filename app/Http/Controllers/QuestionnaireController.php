<?php

namespace App\Http\Controllers;

use App\Category;
use App\Questionnaire;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
}
