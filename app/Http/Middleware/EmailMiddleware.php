<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class EmailMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user();
        $diff=Carbon::parse($user->created_at)->diffInDays();
        if($diff > 30){
            //user can't login and should confirm the email
            return redirect(url('auth/email'));
        }elseif( !$user->confirmed ){
            Flash::info(trans('users.pleaseConfirmEmail', ['remain' => (30-$diff)])."&ensp;<b><a href='".url('auth/email')."'>".trans('users.confirmEmailResend')."</a></b>" );
        }
        return $next($request);
    }
}
