<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class PostManagementController extends Controller
{
    public function index($profile=null){
        if($profile!=null){
            $posts=$profile->posts()->latest()->paginate(20);
        }else{
            $posts=Post::latest()->paginate(20);
        }
        return view('admin.post.index',compact('posts','profile'))->with(['title'=>'Post Management']);
    }

    public function changeStatus(Post $post){
        if($post->status==1){
            $post->update(['status'=>0]);
            Flash::success(trans('admin/messages.postBan'));
        }elseif($post->status==0){
            $post->update(['status'=>1]);
            Flash::success(trans('admin/messages.postActivate'));
        }
        return redirect()->back();

    }
}
