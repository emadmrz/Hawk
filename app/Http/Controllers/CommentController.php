<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;

class CommentController extends Controller
{

    public function article(Request $request, Article $article){
        $user = Auth::user();
        $article->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $article->update(['num_comment'=>$article->comments()->count()]);
        Flash::success(trans('message.articleCommentAdded'));
        return redirect()->back();
    }

    public function post(Request $request, Post $post){
        $user = Auth::user();
        $comment = $post->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $num_comments = $post->comments()->count();
        $post->update(['num_comment'=>$num_comments]);
        return [
            'hasCallback'=>1,
            'callback'=>'post_comment',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'new_comment'=> view('partials.postComment', compact('comment','post'))->render(),
                'num_comments'=>$num_comments
            ]
        ];
    }

    public function postDelete(Request $request,Post $post, Comment $comment){
        if ($request->user()->cannot('delete-post-comment', [$post, $comment])) {
            abort(403);
        }
        $comment->delete();
        $num_comments = $post->comments()->count();
        $post->update(['num_comment'=>$num_comments]);
        return [
            'hasCallback'=>1,
            'callback'=>'post_comment_delete',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'num_comments'=>$num_comments
            ]
        ];
    }

    public function postUpdate(Request $request,Post $post, Comment $comment){
        if ($request->user()->cannot('update-post-comment', $comment)) {
            abort(403);
        }
        $comment->update(['body'=>$request->input('value')]);
    }
}
