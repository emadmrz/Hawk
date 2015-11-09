<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class FeedbackController extends Controller
{

    public function index(){
        $user=Auth::user();
        $feedbacks=Feedback::latest()->paginate(20);
        return view('profile.feedback.show',compact('user','feedbacks'))->with(['title'=>'نظرات من']);
    }

    public function create(){
        $user=Auth::user();
        return view('profile.feedback.create',compact('user'))->with(['title'=>'ثبت نظر']);
    }

    public function store(Request $request){
        $user=Auth::user();
        $this->validate($request,[
            'title'=>'required|min:3',
            'body'=>'required|min:3'
        ]);
        $user->feedbacks()->create([
            'title'=>$request->input('title'),
            'body'=>$request->input('body'),
            'link'=>$request->input('link')
        ]);
        Flash::success(trans('messages.feedbackSent'));
        return redirect()->back();
    }

    /**
     * Created By Dara on 11/9/2015
     * admin panel feedbacks
     */
    public function adminShow(Request $request){
        $cat=$request->input('cat');
        if($cat=='all'){
            $feedbacks=Feedback::latest()->paginate(20);
        }elseif($cat=='new'){
            $feedbacks=Feedback::latest()->where('status',0)->paginate(20);
        }else{
            $feedbacks=Feedback::latest()->where('status',0)->paginate(20);
        }
        return view('admin.feedback.index',compact('feedbacks'))->with(['title'=>'Feedbacks']);
    }

    public function adminSeen(Feedback $feedback){
        $feedback->update([
            'status'=>1
        ]);
        return redirect()->back();
    }

    public function adminUnseen(Feedback $feedback){
        $feedback->update([
            'status'=>0
        ]);
        return redirect()->back();
    }
}
