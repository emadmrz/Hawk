<?php

namespace App\Http\Controllers\Admin;

use App\University;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class UniversityController extends Controller
{
    public function index(){
        $universities=University::all();
        return view('admin.setting.universities', compact('universities'))->with(['title'=>'University List/Add New/Edit','hasEdit'=>0]);
    }

    public function create(Request $request){
        University::create($request->all());
        Flash::success(trans('admin/messages.UniversityAdded'));
        return redirect()->back();
    }

    public function edit($university_edit){
        $universities=University::all();
        return view('admin.setting.universities', compact('universities', 'university_edit'))->with(['title'=>'University List/Add New/Edit','hasEdit'=>1]);
    }

    public function update ($university_edit, Request $request){
        $university_edit->update(['name'=>$request->input('name'), 'logo'=>$request->input('logo')]);
        Flash::success(trans('admin/messages.universityUpdated'));
        return redirect(route('admin.setting.universities'));
    }

    public function delete($province_edit){
        $province_edit->delete();
        Flash::success(trans('admin/messages.universityDeleted'));
        return redirect(route('admin.setting.universities'));
    }
}
