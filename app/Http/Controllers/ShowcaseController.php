<?php

namespace App\Http\Controllers;

use App\Showcase;
use App\Stream;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ShowcaseController extends Controller
{
    public function create(User $profile){
        $user = Auth::user();
        if($user->id != $profile->id){
            if(!$user->showcases()->where('profile_id', $profile->id)->where('updated_at', '>=', Carbon::now()->subMonth())->exists()){
                $showcase = $user->showcases()->create(['profile_id'=>$profile->id, 'status'=>0, 'approved'=>0]);
                $this->requestStream($showcase);
                Flash::success('showcase created');
                return redirect(route('profile.management.addon.showcase.myRequest'));
            }else{
                Flash::message('you can only send one request per mounth');
            }
        }
        return redirect()->back();

    }

    public function status(Showcase $showcase, Request $request){
        if($showcase->status == 1){
            $showcase->update(['status'=>0]);
        }elseif($showcase->status == 0){
            $showcase->update(['status'=>1]);
        }
        return redirect()->back();
    }

    public function approved(Showcase $showcase, Request $request){
        if($showcase->approved == 1){
            $showcase->update(['approved'=>0]);
        }elseif($showcase->approved == 0){
            $showcase->update(['approved'=>1]);
            $this->approvedStream($showcase);
        }
        return redirect()->back();
    }

    public function myRequest(){
        $user = Auth::user();
        $requests = $user->showcases;
        return view('store.showcase.index', compact('requests', 'user'))->with(['title'=>'تبلیغات در پروفایل', 'situation'=>'درخواست های تبلیغ من']);
    }

    public function requestToMe(){
        $user = Auth::user();
        $requests = $user->profileShowcases;
        return view('store.showcase.index', compact('requests', 'user'))->with(['title'=>'تبلیغات در پروفایل', 'situation'=>'درخواست های تبلیغ من']);
    }

    public function activeRequest(){
        $user = Auth::user();
        $requests = $user->showcases()->active()->get();
        return view('store.showcase.index', compact('requests', 'user'))->with(['title'=>'تبلیغات در پروفایل', 'situation'=>'درخواست های تبلیغ من']);
    }

    public function requestStream(Showcase $showcase){
        Stream::create([
            'user_id'=>$showcase->profile_id,
            'contentable_id'=>$showcase->id,
            'contentable_type'=>'App\Showcase',
            'parentable_id'=>$showcase->user_id,
            'parentable_type'=>'App\User',
            'is_see'=>0
        ]);
    }

    public function approvedStream(Showcase $showcase){
        Stream::create([
            'user_id'=>$showcase->user_id,
            'contentable_id'=>$showcase->id,
            'contentable_type'=>'App\Showcase',
            'parentable_id'=>$showcase->profile_id,
            'parentable_type'=>'App\User',
            'is_see'=>0
        ]);
    }


}
