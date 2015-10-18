<?php

namespace App\Http\Controllers;

use App\Info;
use App\Province;
use App\University;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{

    public function index(){
        $user=Auth::user();
        $info = $user->info()->with('user')->firstOrCreate(['user_id'=>$user->id]);
        $provinces = Province::where('parent_id', null)->lists('name', 'id');
        if(!is_null($info->province_id)) {
            $cities = Province::where('parent_id', $info->province_id)->lists('name', 'id');
        }else{
            $cities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        }
        $location = $user->location()->firstOrCreate(['user_id'=>$user->id]);
        return view('profile.index', compact('info', 'provinces', 'cities','location'))->with(['title'=>$user->first_name]);
    }

    public function description(Request $request){
        if($request->ajax()){
            Auth::user()->update(['description'=>$request->input('description')]);
            return [
                'hasCallback'=> 0,
                'callback'=>'user_info',
                'hasMsg'=>0,
                'msg'=>'',
                'returns'=> ''
            ];
        }
    }

    public function test(){
        session(['tracker' => 'emad emad']);
//        echo session('tracker');
    }
}
