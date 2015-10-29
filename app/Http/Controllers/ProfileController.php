<?php

namespace App\Http\Controllers;

use App\Advantage;
use App\Info;
use App\Province;
use App\University;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $advantages = Advantage::get();
        $shop = $user->shop;
        if(count($shop)){ $advantage_shop = $user->shop->advantages()->lists('advantage_id')->toArray();}else{$advantage_shop = [];}
        return view('profile.index', compact('info', 'provinces', 'cities','location', 'user', 'advantages', 'advantage_shop', 'shop'))->with(['title'=>$user->first_name]);
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

    public function related(Request $request){
        $user = User::findOrFail($request->input('id'));
        $skills = $user->skills;
        $skill_categories =$skills->lists('sub_category_id')->toArray();
        $skill_categories = implode(',', $skill_categories);
        $info = $user->info;
        $city_id = ($info->city_id == null) ? 0 : $info->city_id;
        $province_id = ($info->province_id == null) ? 0 : $info->province_id_id;
        $users = User::join('skills', 'skills.user_id', '=', 'users.id')
            ->join('infos', 'infos.user_id', '=', 'users.id')
            ->select(DB::raw("(CASE WHEN skills.sub_category_id IN (".$skill_categories.") THEN 1 ELSE 0 END) +
                (CASE WHEN users.first_name LIKE '%".$user->first_name."%' THEN 10 ELSE 0 END) +
                (CASE WHEN users.last_name LIKE '%".$user->last_name."%' THEN 1 ELSE 0 END) +
                (CASE WHEN infos.city_id = ".$city_id." THEN 10 ELSE 0 END) +
                (CASE WHEN infos.province_id = ".$province_id." THEN 5 ELSE 0 END) +
                (CASE WHEN skills.title = ".$province_id." THEN 5 ELSE 0 END)
             AS relevance"))
            ->get();

        dd($users);

        $categories = $user->skills->lists('category_id','sub_category_id')->toArray();
        dd($categories);
    }

    public function test(){
        session(['tracker' => 'emad emad']);
//        echo session('tracker');
    }
}
