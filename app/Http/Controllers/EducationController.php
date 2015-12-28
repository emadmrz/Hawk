<?php

namespace App\Http\Controllers;

use App\Education;
use App\University;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function create(Request $request){
        $user =  Auth::user();
        $input=$request->all();
        $university_id=$this->registerUniversity($request);
        $input['university_id']=$university_id;
        if($university_id==0){ //none selected
            $input['university_id']='';
        }
        $user->educations()->create($input);

        return [
            'hasCallback'=>'1',
            'callback'=>'user_educations',
            'hasMsg'=>'1',
            'msg'=>'Education inserted successfully',
            'returns'=>$user->educations()->with('university')->get()
        ];

    }

    public function delete(Request $request){
        $education_id = $request->input('education_id');
        $education= Education::find($education_id);
        if($education->user_id == Auth::user()->id ){
            $education->delete();
            return $education_id;
        }else{
            return null;
        }
    }

    public function update(Request $request){
        Education::find($request->input('pk'))->update([$request->input('name')=>$request->input('value')]);
    }

    /**
     * Created By Dara on 25/12/2015
     * register university select2 plugin
     */
    private function registerUniversity($request){
        $universities=University::all()->lists('name','id')->toArray();
        $selected=$request->input('university_id');
        if(!array_key_exists($selected,$universities) && $selected!='0'){ //new university selected
            $university=University::create(['name'=>$selected]);
            $selected=$university->id;
        }
        return $selected;

    }
}
