<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Mail;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $input=$request->all();
        $input['confirmation_code']=str_random(30);
        $newUser = $this->create($input);
        $newUser->attachRole($input['role']);
        Auth::login($newUser);
        Mail::send('emails.welcome', ['user'=>$input], function ($message)use ($input)  {
            $message->to($input['email'])->subject('welcome to skillema');
        });
        return redirect(route('profile.me'));
//        return redirect($this->redirectPath());
    }


}
