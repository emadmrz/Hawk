<?php

namespace App\Http\Controllers;

use App\Post;
use App\Report;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laracasts\Flash\Flash;

class ReportController extends Controller
{
    public function index(){
        $user=Auth::user();
        $reports=Report::latest()->paginate(20);
        return view('profile.report.show',compact('user','reports'))->with(['title'=>'نظرات من']);
    }

    public function create(Request $request){
        $user=Auth::user();
        $type=$request->input('type');
        $id=$request->input('id');
        return view('profile.report.create',compact('user','type','id'))->with(['title'=>'ثبت گزارش']);
    }
    public function store(Request $request){
        $user=Auth::user();
        $this->validate($request,[
            'title'=>'integer|required|in:'.implode(',',array_keys(Config::get('report.title'))),
            'description'=>'required|min:3',
            'type'=>'required|string',
            'id'=>'required|integer'
        ]);
        $type=$this->makeModel($request->input('type'));
        $item=$type::findOrFail($request->input('id'));
        //check if the user is authorized tm report this item
        $user->reports()->create([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'itemable_id'=>$item->id,
            'itemable_type'=>$type
        ]);
        Flash::success(trans('messages.reportSent'));
        return redirect()->back();
    }


    /**
     * Created By Dara on 11/9/2015
     * admin panel reports
     */
    public function adminShow(Request $request){
        $cat=$request->input('cat');
        if($cat=='all'){
            $reports=Report::latest()->paginate(20);
        }elseif($cat=='new'){
            $reports=Report::latest()->where('status',0)->paginate(20);
        }else{
            $reports=Report::latest()->where('status',0)->paginate(20);
        }
        return view('admin.report.index',compact('reports'))->with(['title'=>'Reports']);
    }

    public function adminSeen(Report $report){
        $report->update([
            'status'=>1
        ]);
        return redirect()->back();
    }

    public function adminUnseen(Report $report){
        $report->update([
            'status'=>0
        ]);
        return redirect()->back();
    }

    private function makeModel($type){
        if($type=='post'){
            return 'App\Post';
        }elseif($type=='article'){
            return 'App\Article';
        }elseif($type=='problem'){
            return 'App\Problem';
        }
    }

}
