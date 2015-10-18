<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class StorageMiddleware
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
        $user = Auth::user();
        $storage = $user->usage;
        if($storage->capacity <= $storage->usage){
            if($request->ajax()){
                return [
                    'hasCallback'=>0,
                    'callback'=>'',
                    'hasMsg'=>1,
                    'msgType'=>'danger',
                    'msg'=>'storage full recharge',
                    'returns'=>['status'=>0]
                ];
            }else{
                Flash:error("storage full recharge");
                return redirect()->back();
            }
        }
        return $next($request);
    }
}
