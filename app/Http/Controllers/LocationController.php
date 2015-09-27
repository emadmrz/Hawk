<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function store(Request $request){
        Auth::user()->location()->update($request->only('lat','lng'));
        return [
            'hasCallback'=>0,
            'callback'=>'',
            'hasMsg'=>1,
            'msg'=>'موقعیت شما بر روی نقشه با موفقیت ذخیره شد.',
            'msgType'=>'success',
            'returns'=>''
        ];
    }
}
