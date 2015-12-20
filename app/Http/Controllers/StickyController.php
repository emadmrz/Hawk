<?php

namespace App\Http\Controllers;

use App\Sticky;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StickyController extends Controller
{
    public function store(User $profile){
        $user = Auth::user();
        $sticky = $user->stickies()->create([
            'profile_id'=>$profile->id,
            'body'=> '',
        ]);
        return [
            'hasCallback'=>1,
            'callback'=>'sticky_note_created',
            'hasMsg'=>0,
            'msg'=>'',
            'returns'=>[
                'id'=> $sticky->id,
            ]
        ];
    }

    public function update(Sticky $sticky, Request $request){
        $sticky->update($request->all());
    }

    public function delete(Sticky $sticky){
        $sticky->delete();
    }
}
