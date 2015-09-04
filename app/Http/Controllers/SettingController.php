<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laracasts\Flash\Flash;
use Morilog\Jalali\Facades\jDate;

class SettingController extends Controller
{
    /**
     * Created by Emad Mirzaie on 02/09/2015.
     * change password form
     */
    public function password(){
        $last_update=jDate::forge(Auth::user()->updated_at)->ago();
        return view('profile.password',compact('last_update'))->with(['title'=>trans('profile.changePassword')]);
    }

    /**
     * Created by Emad Mirzaie on 02/09/2015.
     * change password via post request from password form
     */
    public function changePassword(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'current_password' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        if( $request->input('email') == $user->email && Hash::check($request->input('current_password'), $user->password) ) {
            Auth::user()->update(['password'=>bcrypt($request->input('password'))]);
            Flash::success( trans('users.passwordChanged') );
        }else{
            Flash::error(trans('users.passwordChangeFail'));
        }
        return redirect()->back();

    }
}
