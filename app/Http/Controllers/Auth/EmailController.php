<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;

class EmailController extends Controller
{
    /**
     * Created by Emad Mirzaie on 03/09/2015.
     * This Controller handle email confirmation which contains index , resend code , and check with confirmation
     */

    public function index(){
        $user=Auth::user();
        return view('general.EmailConfirmation', compact('user'))->with(['title'=>'فعال سازی ایمیل']);
    }

    public function resend(){
        $user=Auth::user();
        if(!$user->confirmed){
            $new_code=str_random(30);
            $user->update(['confirmation_code'=>$new_code]);
            $input=$user->toArray();
            Mail::send('emails.welcome', ['user'=>$input], function ($message)use ($input)  {
                $message->to($input['email'])->subject('welcome to skillema');
            });
            Flash::success(trans('users.confirmationEmailResended'));
        }
        return redirect()->back();
    }

    public function check($confirmation_code){
        if (Auth::check()) { //check if a user logged in
            $user=Auth::user();
        }else{
            $user = User::where('confirmation_code',$confirmation_code)->firstOrFail();
        }
        if(!$user->confirmed){ //check if the user previously confirmed
            if( $user->confirmation_code == $confirmation_code ){
                $user->update(['confirmed'=>1]);
                Auth::login($user);
                Flash::success(trans('users.emailConfirmed'));
            }else{
                Flash::error(trans('users.emailCodeMismatch'));
            }
            return redirect(route('home.home'));
        }else{
            return redirect(route('home.home'));
        }

        return redirect(url('auth/email'));
    }
}
