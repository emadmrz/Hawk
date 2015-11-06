<?php

namespace App\Http\Controllers;

use App\Group;
use App\Post;
use App\Repositories\FriendRepository;
use App\Repositories\GroupRepository;
use App\Stream;
use App\User;
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
        $post = $user->posts()->create([
            'content' => $request->input('content'),
            'image' => $request->input('image'),
            'location' => $request->input('location'),
            'parentable_id' => $user->id,
            'parentable_type' => 'App\User'

        ]);
        $this->stream($post);
        Flash::success(trans('profile.postAdded'));
        return redirect()->back();
    }

    public function index(){
        $user = Auth::user();
        $posts = $user->posts()->paginate(10);
        return view('profile.postsList',compact('posts'))->with(['title'=>'لیست پست های من']);
    }

    public function delete(Post $post){
        $post->delete();
        Flash::success(trans('profile.postDelete'));
        return redirect()->back();
    }

    public function preview(Post $post){
        return view('profile.postPreview', compact('post'))->with(['title'=>'پست من']);
    }

    public function otherPreview(User $user, Post $post){
        return view('home.postPreview', compact('post', 'user'))->with(['title'=>'پست من']);
    }

    private function stream($post){
        $friendRepository = new FriendRepository();
        $friends = $friendRepository->myFriends();
        $user = Auth::user();
        foreach($friends as $friend){
            Stream::create([
                'user_id'=>$friend->friend_info->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $post->id,
                'contentable_type'=> 'App\Post',
                'parentable_id'=>$user->id,
                'parentable_type'=>'App\User',
                'is_see'=>0
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'edge_ranke'=> 0,
            'contentable_id'=> $post->id,
            'contentable_type'=> 'App\Post',
            'parentable_id'=>$user->id,
            'parentable_type'=>'App\User',
            'is_see' => 1
        ]);
    }

    /**
     * Created By Dara on 31/10/2015
     * managing group posts
     */
    public function postGroupPreview(Group $group,Post $post){
        $user=Auth::user();
        return view('group.postPreview', compact('post','group','user'))->with(['title' =>str_limit($post->content,20)]);
    }

    public function addGroupPost(Group $group, Request $request)
    {
        if($request->user()->cannot('join-group',[$group])){
            $this->validate($request, [
                'content' => 'required|min:3'
            ]);
            $user = Auth::user();
            $post = $user->posts()->create([
                'content' => $request->input('content'),
                'image' => $request->input('image'),
                'location' => $request->input('location'),
                'parentable_id' => $group->id,
                'parentable_type' => 'App\Group',
            ]);
            $this->groupStream($post,$group);
        }
        return redirect()->back();
    }

    /**
     * Created By Dara on 1/11/2015
     * group post stream
     */
    private function groupStream($post, $group)
    {
        $user=Auth::user();
        $groupRepository = new GroupRepository();
        $joins = $groupRepository->getAllJoinUsers($group); //return the users of the group except current
        foreach ($joins as $join) {
            Stream::create([
                'user_id'=>$join->id,
                'contentable_id'=>$post->id,
                'contentable_type'=>'App\Post',
                'parentable_id'=>$group->id,
                'parentable_type'=>'App\Group',
                'is_see'=>0
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'contentable_id'=>$post->id,
            'contentable_type'=>'App\Post',
            'parentable_id'=>$group->id,
            'parentable_type'=>'App\Group',
            'is_see'=>1
        ]);
    }

}
