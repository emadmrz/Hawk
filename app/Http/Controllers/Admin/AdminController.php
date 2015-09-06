<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class AdminController extends Controller
{
    public function index(){
        $users=Role::find(1)->users()->paginate(20);
        return view('admin.admins.index', compact('users'))->with(['title'=>'Admins Management']);

    }
    public function create(){
        return view('admin.admins.create')->with(['title'=>'create admin']);
    }
    public function store(Request $request){
        $this->validate($request, [
            'first_name'=>'required|max:255|min:3',
            'last_name'=>'required|max:255|min:3',
            'email'=>'required|max:255|min:3|email|unique:users',
            'password'=>'required|max:255|min:6',
        ]);
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
        return view('admin.admins.edit', compact('user'))->with(['title'=>'Edit Admin']);
    }
    public function update(User $user,Requests\UserRequest $request){
        $user->update($request->except(['created_at','updated_at','user_role_name','email']));
        Flash::success(trans('admin/messages.adminUpdate'));
        return redirect(route('admin.admins.list'));
    }
}
