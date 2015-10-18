<?php

namespace App\Http\Controllers;

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
}
