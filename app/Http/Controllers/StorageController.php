<?php

namespace App\Http\Controllers;

use App\Storage;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class StorageController extends Controller
{
    /**
     * Created By Dara on 25/12/2015
     * user-storage admin control
     */
    public function adminIndex(User $user){
        $storages=$user->storages()->paginate(20);
        return view('admin.storage.index',compact('user','storages'))->with(['title'=>'Storage Management']);
    }

    public function adminChange(User $user,Storage $storage){
        if($storage->active==0){ //the storage already banned
            $storage->update(['active'=>1]);
            if($storage->status==1){
                $user->usage->freeup($storage->capacity);
            }
            Flash::success(trans('admin/messages.storageActivate'));
        }elseif($storage->active==1){ //the storage already activated
            $storage->update(['active'=>0]);
            if($storage->status==1){
                $user->usage->freeDown($storage->capacity);
            }
            Flash::success(trans('admin/messages.storageBan'));
        }
        return redirect()->back();
    }
}
