<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class ArticleManagementController extends Controller
{
    public function index($profile=null){
        if($profile!=null){
            $articles=$profile->articles()->latest()->paginate(20);
        }else{
            $articles=Article::latest()->paginate(20);
        }
        return view('admin.article.index',compact('articles','profile'))->with(['title'=>'Article Management']);
    }

    public function changeStatus(Article $article){
        if($article->stat==1){
            $article->update(['stat'=>0]);
            Flash::success(trans('admin/messages.articleBan'));
        }elseif($article->stat==0){
            $article->update(['stat'=>1]);
            Flash::success(trans('admin/messages.articleActivate'));
        }
        return redirect()->back();

    }
}
