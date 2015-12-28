<?php

namespace App\Http\Controllers;

use App\Credit;
use App\Event;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Morilog\Jalali\Facades\jDate;

class CreditController extends Controller
{
    public function index(){
        $user=Auth::user();
        $credits=$user->credits()->latest()->paginate(20);
        $cash=$this->getCash();
        return view('profile.credit.index',compact('user','credits','cash'))->with(['title'=>'کیف پول من']);
    }

    /**
     * Created By Dara on 6/11/2015
     * get the money for the user
     */
    public function getCash(){
        $user=Auth::user();
        return $user->credits()->sum('amount');
    }

    /**
     * Created By Dara on 6/11/2015
     * show list of credits for users in admin panel
     */
    public function adminIndex($user=null){
        $users=[];
        if($user!=null){
            $users[]=$user;
        }else{
            $users=User::latest()->with('roles')->paginate(20);
        }

        return view('admin.credit.index',compact('users'))->with(['title'=>'Balance management']);
    }

    public function edit(User $user){
        return view('admin.credit.edit',compact('user'))->with(['title'=>'Balance management']);
    }

    public function update(User $user,Request $request){
        $this->validate($request,[
            'amount'=>'required|integer|min:10',
            'operation'=>'required|in:0,1',
            'description'=>'required|min:3'
        ]);
        $amount=abs($request->input('amount'));
        //check if the credit is settle or removal
        if($request->input('operation')==0){ //removal
            $amount=$amount*(-1);
        }elseif($request->input('operation')==1){ //settle
            $amount=$amount*1;
        }
        Credit::create([
            'user_id'=>$user->id,
            'amount'=>$amount,
            'description'=>$request->input('description')
        ]);
        Flash::success(trans('admin/messages.balanceUpdated'));
        return redirect(route('admin.credit.index'));
    }
}
