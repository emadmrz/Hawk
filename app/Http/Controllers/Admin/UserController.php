<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class UserController extends Controller
{
    public function index(User $user){
//        $user->with('roles')->findOrFail(5);
//        return $users->findOrFail(5)->roles()->get();
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

}
