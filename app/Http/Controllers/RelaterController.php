<?php

namespace App\Http\Controllers;

use App\Relater;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RelaterController extends Controller
{
    /**
     * Created By Dara on 25/12/2015
     * user-poll admin control
     */
    public function adminIndex(User $user){
        $relaters=$user->relaters()->paginate(20);
        return view('admin.relater.index',compact('relaters','user'))->with(['title'=>'User Relater Management']);
    }

    public function adminChange(User $user,Relater $relater){
        if($relater->active==0){ //the relater is already disabled
            $relater->update(['active'=>1]);
            Flash::success(trans('admin/messages.relaterActivate'));
        }elseif($relater->active==1){ //the relater is already enabled
            $relater->update(['active'=>0]);
            Flash::success(trans('admin/messages.relaterBan'));
        }
        return redirect()->back();
    }
}
