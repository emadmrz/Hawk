<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function edit(Request $request){
        $user = Auth::user();
        $account=$request->only('user');
        $info = $request->except('user', 'email','_token');
        $user->update($account['user']);
        $user->info()->update($info);
        $input=$request->all();
        $input['city']=$user->info->city;
        $input['province']=$user->info->province;
        return [
            'hasCallback'=>'1',
            'callback'=>'user_info',
            'hasMsg'=>'1',
            'msg'=>'data inserted successfully',
            'returns'=>$input
        ];
    }
}
