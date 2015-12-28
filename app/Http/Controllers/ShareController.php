<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Chencha\Share\Share;
use Chencha\Share\ShareFacade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShareController extends Controller
{
    public function article(Article $article, Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'social' => 'required',
        ]);
        $social = $request->input('social');
        $user->shares()->create([
            'shareable_id'=>$article->id,
            'shareable_type'=>'App\Article',
            'num_visit'=>0,
            'social'=> $social,
        ]);
        return redirect($this->share(route('home.article.preview', [$article->user_id, $article->id]), $article->title, $social ));
    }

    private function share($route, $title, $social){
        if($social == 'linkedin'){
            return ShareFacade::load($route, $title)->linkedin();
        }elseif($social == 'facebook'){
            return ShareFacade::load($route, $title)->facebook();
        }elseif($social == 'twitter'){
            return ShareFacade::load($route, $title)->twitter();
        }elseif($social == 'gmail'){
            return ShareFacade::load($route, $title)->gmail();
        }
    }

    /**
     * Created By Dara on 26/12/2015
     * addon (share) admin control
     */
    public function adminIndex(User $user){
        $shares=$user->shares()->latest()->paginate(20);
        return view('admin.share.index',compact('shares','user'))->with(['title'=>'Share Addon Management']);
    }
}
