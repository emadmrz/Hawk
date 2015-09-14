<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;

class PostController extends Controller
{
    public function image(Request $request){
        $imageName = str_random(20) . '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/img/files/', $imageName);
        $img_address = public_path() . '/img/files/' . $imageName;
        $img = Image::make($img_address);
        // resize the image to a width of 300 and constrain aspect ratio (auto height)
        $img->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($img_address, 90);
        return asset('img/files/'.$imageName);
    }

    public function add(Request $request){
        $user = Auth::user();
        $user->posts()->create($request->all());
        Flash::success(trans('profile.postAdded'));
        return redirect()->back();
    }
}
