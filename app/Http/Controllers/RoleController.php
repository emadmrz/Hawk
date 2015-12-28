<?php

namespace App\Http\Controllers;

use App\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function adminIndex(User $user){
        $userRoles=$user->roles()->lists('role_id')->toArray();
        $roles=Role::whereNotIn('id',$userRoles)->latest()->lists('name','id');
        return view('admin.role.index',compact('user','roles'))->with(['title'=>'User Role Management']);
    }

    public function adminSubmit(User $user,Request $request){
        $h=implode(',',Role::latest()->lists('id')->toArray());
        $this->validate($request,[
           'role'=>"required|in:{$h}",
        ]);
        $input=$request->except('_token');
        $role=$input['role'];
        $roleObject=Role::find($role);
            if(!$user->is($role)){
                if($roleObject->slug=='user' || $roleObject->slug=='legal'){
                    if(!$user->is('user') && !$user->is('legal')){
                        $user->attachRole($role);
                    }
                }else{
                    $user->attachRole($role);
                }
            }
        return redirect()->back();
    }

    public function adminDelete(User $user,Role $role){
        if($user->is($role->id)){
            $user->detachRole($role);
        }
        return redirect()->back();
    }
}
