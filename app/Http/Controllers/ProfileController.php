<?php

namespace App\Http\Controllers;

use App\Info;
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
        return view('profile.index', compact('info'))->with(['title'=>$user->first_name]);
    }

    public function description(Request $request){
        if($request->ajax()){
            Auth::user()->update(['description'=>$request->input('description')]);
        }
    }

    public function test(){
        session(['tracker' => 'emad emad']);
//        echo session('tracker');
    }
}
