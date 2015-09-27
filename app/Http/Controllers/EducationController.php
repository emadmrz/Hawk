<?php

namespace App\Http\Controllers;

use App\Education;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function create(Request $request){
        $user =  Auth::user();
        $user->educations()->create($request->all());

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
}
