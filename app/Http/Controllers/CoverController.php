<?php

namespace App\Http\Controllers;

use App\Repositories\CropperRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CoverController extends Controller
{
    public function index(Request $request, CropperRepository $cropperRepository){
        $user = Auth::user();
        $baseName=$user->id.str_random(20);
        $imageName = $baseName.'.'.$request->file('avatar_file')->getClientOriginalExtension();
        $request->file('avatar_file')->move(public_path() . '/img/'.$this->imageDirectory($request->input('type')).'/', $imageName);
        $response=$cropperRepository->crop(
            $baseName,
            $this->imageDirectory($request->input('type')),
            public_path() . '/img/'.$this->imageDirectory($request->input('type')).'/'.$imageName,
            $request->input('avatar_data')
        );
        if($response['isDone']){
            if($request->input('type')=='avatar'){
                $user->update(['image'=>$baseName.'.png']);
            }
            if($request->input('type')=='cover'){
                $user->update(['cover'=>$baseName.'.png']);
            }
        }
        $response['type']=$request->input('type');
        return $response;
    }

    public function deleteAvatar(Request $request){
        $user = Auth::user();
        if(!is_null($user->image)){
            unlink(public_path().'/img/persons/'.$user->image);
            $user->update(['image'=>null]);
        }
        return redirect()->back();
    }

    public function deleteCover(Request $request){
        $user = Auth::user();
        if(!is_null($user->cover)){
            unlink(public_path().'/img/cover/'.$user->cover);
            $user->update(['cover'=>null]);
        }
        return redirect()->back();
    }

    private function imageDirectory($type){
        $directory=[
            'avatar' => 'persons',
            'cover' => 'cover'
        ];
        return $directory[$type];
    }
}
