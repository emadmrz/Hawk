<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Event;
use App\Settle;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class SettleController extends Controller
{

    /**
     * Created By Dara on 7/11/2015
     * show all settles for the user
     */
    public function index(){
        $user=Auth::user();
        $settles=$user->settles()->orderBy('created_at','DESC')->paginate(20);
        return view('profile.settle.index',compact('user','settles'))->with(['title'=>'درخواست های تسویه']);
    }

    public function create(CreditController $creditController){
        $user=Auth::user();
        $cash=$creditController->getCash();
        return view('profile.settle.create',compact('user','cash'))->with(['title'=>'درخواست تسویه']);
    }

    public function store(CreditController $creditController,Request $request){
        if ($request->user()->cannot('can-settle')) {
            abort(403);
        }
        $this->validate($request,[
           'bank'=>'required|in:0,1',
            'account_number'=>'required',
            'way'=>'required|in:0,1,2'
        ]);
        if($request->input('way')==1 ||$request->input('way')==2){
            $this->validate($request,[
               'account_sheba'=>'required'
            ]);
        }
        $user=Auth::user();
        $amount=$creditController->getCash();
        $bank=$this->getBank($request->input('bank'));
        $way=$this->getWay($request->input('way'));
        $user->settles()->create([
            'amount'=>$amount,
            'bank'=>$bank,
            'way'=>$way,
            'account_number'=>$request->input('account_number'),
            'account_sheba'=>$request->input('account_sheba')
        ]);
        Flash::success(trans('messages.settleInformed'));
        return redirect(route('profile.management.credit'));

    }

    public function edit(Settle $settle){
        return view('admin.credit.settle.edit',compact('settle'))->with(['title'=>'Settlement Management']);
    }

    public function update(Settle $settle,Request $request){
        $this->validate($request,[
            'operation'=>'required|in:0,1',
            'description'=>'required'
        ]);
        if($request->input('operation')==1){ // the settle has been denied
            $settle->update([
                'description'=>$request->input('description'),
                'status'=>2
            ]);
            Flash::error(trans('admin.messages.settleDenied'));
            return redirect(route('admin.settle.requests'));
        }elseif($request->input('operation')==0){ //the settle has been approved
            $settle->update([
                'description'=>$request->input('description'),
                'status'=>1
            ]);
            // add record to the credits table
            $userId=$settle->user_id;
            Credit::create([
                'user_id'=>$userId,
                'amount'=>($settle->amount)*(-1),
                'description'=>$request->input('description'),
            ]);
            Flash::success(trans('admin.messages.settleApproved'));
            return redirect(route('admin.settle.requests'));
        }
    }

    /**
     * Created By Dara on 7/11/2015
     * show all the users settle request
     */
    public  function seeAllRequests(){
        $requests=Settle::latest()->paginate(20);
        return view('admin.credit.settle.show',compact('requests'))->with(['title'=>'Settle Requests']);
    }

    /**
     * Created By Dara on 7/11/2015
     * get bank name && get transfer way name
     */
    private function getBank($value){
        $bank=[
            0=>'ملت',
            1=>'پاسارگاد'
        ];
        return $bank[$value];

    }

    private function getWay($value){
        $way=[
            0=>'کارت به کارت',
            1=>'ساتنا',
            2=>'پایا'
        ];
        return $way[$value];
    }
}
