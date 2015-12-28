<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    public function index(User $user){
//        $user->with('roles')->findOrFail(5);
//        return $users->findOrFail(5)->roles()->get();
//        $aaa=Role::find(1)->users()->get();
//        dd($aaa);
        $users = $user->with('roles')->paginate(20);
        return view('admin.users.index', compact('users'))->with(['title'=>'Users Management']);
    }

    public function edit($user){
        return view('admin.users.edit', compact('user'))->with(['title'=>'Edit User']);
    }

    public function update(UserRequest $request, User $user){
        $user->update($request->all());
        Flash::success(trans('admin/messages.userUpdate'));
        return redirect(route('admin.users.list'));
    }

    public function delete(User $user){
        $user->delete();
        Flash::success(trans('admin/messages.userDelete'));
        return redirect(route('admin.users.list'));
    }

    public function select(User $user){
        $educations=$user->educations()->latest()->paginate(20);
        $infos=$user->info()->latest()->paginate(20);
        $bio=$user->biography()->first();
        return view('admin.users.management', compact('user','educations','infos','bio'))->with(['title'=>$user->username]);
    }

}
