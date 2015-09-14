<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BiographyController extends Controller
{
    public function update(Request $request){
        $user = Auth::user();
        $user->biography()->update(['text'=>$request->input('text')]);
        return [
            'hasCallback'=>'0',
            'callback'=>'user_info',
            'hasMsg'=>'1',
            'msg'=>'biography inserted successfully',
            'returns'=>''
        ];
    }
}
