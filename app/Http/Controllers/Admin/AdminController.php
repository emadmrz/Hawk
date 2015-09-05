<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        return "show admin users list";
    }
    public function create(){
        return view('admin.admins.create')->with(['title'=>'create admin']);
    }
    public function store(Requests\CreateAdminRequest $request){
        $input=$request->all();
        $input['password']=bcrypt($request->input('password'));
        $input['confirmed']=1;
        $newAdmin=User::create($input);
        $newAdmin->attachRole(1);
        Flash::success(trans('admin/messages.adminCreate'));
        return redirect(route('admin.admins.list'));
    }
    public function delete(User $user){
        $user->delete();
        Flash::success(trans('admin/messages.adminDelete'));
        return redirect(route('admin.admins.list'));
    }
    public function edit(User $user){
        return view('admin.admins.edit');
    }
    public function update(User $user,Requests\EditAdminRequest $request){
        $user->update($request->all());
        Flash::success(trans('admin/messages.adminUpdate'));
        return redirect(route('admin.admins.list'));
    }
}
