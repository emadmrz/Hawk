<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $payments = $user->payments()->latest()->get();
        return view('profile.accountant', compact('user', 'payments'))->with(['title'=>'مدیریت تراکنش های بانکی']);
    }

    /**
     * Created By Dara on 22/12/2015
     * user-accountant admin control
     */
    public function adminIndex($user=null){
        if($user==null){
            $payments=Payment::paginate(20);
        }else{
            $payments=$user->payments()->latest()->paginate(20);
        }
        return view('admin.accountant.index',compact('payments','user'))->with(['title'=>'Accountant Management']);
    }
}
