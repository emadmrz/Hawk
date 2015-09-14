<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ArticleController extends Controller
{
    public function create(){
        return view('profile.article')->with(['title'=>'مقاله جدید', 'for'=>'create']);
    }

    public function add(Request $request){
        $user = Auth::user();
        $input = $request->all();
        if($request->hasFile('image')){
            $imageName = str_random(20) . '.' .$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path() . '/img/files/', $imageName);
            $input['banner'] = $imageName;
        }
        $article = $user->articles()->create($input);
        Flash::success( trans('profile.articleAdded') );
        return redirect(route('profile.article.edit',['article'=>$article->id]));
    }

    public function edit(Article $article){
        $attachments = $article->files;
        return view('profile.article', compact('article','attachments'))->with(['title'=>'ویرایش مقاله', 'for'=>'edit']);
    }

    public function update(Article $article, Request $request){
        $article->update($request->all());
        Flash::success( trans('profile.articleEdited') );
        return redirect(route('profile.articles'));
    }

    public function banner(Article $article, Request $request){
        $imageName = str_random(20) . '.' .$request->file('image')->getClientOriginalExtension();
        $request->file('image')->move(public_path() . '/img/files/', $imageName);
        $article->update(['banner'=>$imageName]);
        return asset('img/files/'.$imageName);
    }

    public function index(){
        $user=Auth::user();
        $articles = $user->articles()->with('user')->latest()->paginate(5);
        return view('profile.articlesList', compact('articles'))->with(['title'=>'لیست مقالات']);
    }

    public function preview(Article $article){
        $user = Auth::user();
        $attachments = $article->files;
        return view('profile.articlesPreview', compact('article', 'attachments'))->with(['title'=> $article->title ]);
    }

    public function delete(Article $article){
        $article->delete();
        Flash::success( trans('profile.articleDeleted') );
        return redirect(route('profile.articles'));
    }
}
