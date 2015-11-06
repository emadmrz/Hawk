<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Article;
use App\Comment;
use App\Post;
use App\Problem;
use App\Product;
use App\Shop;
use App\Storage;
use App\Stream;
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
        $comment = $article->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $article->update(['num_comment'=>$article->comments()->count()]);
        $this->stream($comment);
        Flash::success(trans('message.articleCommentAdded'));
        return redirect()->back();
    }

    public function post(Request $request, Post $post){
        $user = Auth::user();
        $comment = $post->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $num_comments = $post->comments()->count();
        $post->update(['num_comment'=>$num_comments]);
        $this->stream($comment);
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

    public function product(Shop $shop, Product $product, Request $request){
        $user = Auth::user();
        $product->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $product->update(['num_comment'=>$product->comments()->count()]);
        Flash::success('comment Added');
        return redirect()->back();
    }

    private function stream($comment){
        $user = Auth::user();
        $owner = $comment->commentable->user;
        if($user->id != $owner->id){
            Stream::create([
                'user_id'=> $owner->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $comment->id,
                'contentable_type'=> 'App\Comment',
                'parentable_id'=>$user->id,
                'parentable_type'=>'App\User',
                'is_see'=>0
            ]);
        }
    }

    public function storage(Request $request){
        $user = Auth::user();
        $storage = Addon::storage()->first();
        $storage->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $storage->update(['num_comment'=>$storage->comments()->count()]);
        Flash::success('comment sent');
        return redirect()->back();
    }

    public function shop(Request $request){
        $user = Auth::user();
        $shop = Addon::shop()->first();
        $shop->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $shop->update(['num_comment'=>$shop->comments()->count()]);
        Flash::success('comment sent');
        return redirect()->back();
    }

    public function questionnaire(Request $request){
        $user = Auth::user();
        $questionnaire = Addon::questionnaire()->first();
        $questionnaire->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $questionnaire->update(['num_comment'=>$questionnaire->comments()->count()]);
        Flash::success('comment sent');
        return redirect()->back();
    }

    public function poll(Request $request){
        $user = Auth::user();
        $poll = Addon::poll()->first();
        $poll->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $poll->update(['num_comment'=>$poll->comments()->count()]);
        Flash::success('comment sent');
        return redirect()->back();
    }

    public function advertise(Request $request){
        $user = Auth::user();
        $advertise = Addon::advertise()->first();
        $advertise->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $advertise->update(['num_comment'=>$advertise->comments()->count()]);
        Flash::success('comment sent');
        return redirect()->back();
    }

    /**
     * Created By Dara on 5/11/2015
     * manage the offer addon comment
     */
    public function offer(Request $request){
        $user=Auth::user();
        $offer=Addon::offer()->first();
        $offer->comments()->create([
           'user_id'=>$user->id,
            'body'=>$request->input('body')
        ]);
        $offer->update(['num_comment'=>$offer->comments()->count()]);
        Flash::success('comment sent');
        return redirect()->back();
    }

    /**
     * Created By Dara on 2/11/2015
     * problem comment handling
     */
    public function problemDelete(Request $request,Problem $problem, Comment $comment){
        if ($request->user()->cannot('delete-problem-comment', [$problem, $comment])) {
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msg'=>'شما مجاز به حذف این پاسخ نمی باشید.',
                'msgType'=>'danger',
                'returns'=> [
                    'num_comments'=>'',
                ]
            ];
        }
        $comment->delete();
        $num_comments = $problem->comments()->count();
        $problem->update(['num_comment'=>$num_comments]);
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

    public function problemUpdate(Request $request,Problem $problem, Comment $comment){
        $comment->update(['body'=>$request->input('value')]);
    }

    public function problem(Request $request,Problem $problem){
        $group=$problem->parentable;
        if ($request->user()->can('join-group', [$group])) {
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msg'=>'تنها اعضای گروه می توانند پاسخ خود را برای این پرسش بیان نمایند.',
                'msgType'=>'danger',
                'returns'=> [
                    'num_comments'=>'',
                ]
            ];
        }
        $user = Auth::user();
        $comment = $problem->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $num_comments = $problem->comments()->count();
        $problem->update(['num_comment'=>$num_comments]);
        $this->groupStream($comment);
        return [
            'hasCallback'=>1,
            'callback'=>'post_comment',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'new_comment'=> view('partials.problemComment', compact('user','comment','problem'))->render(),
                'num_comments'=>$num_comments
            ]
        ];
    }

    public function postGroup(Request $request,Post $post){
        $group=$post->parentable;
        if ($request->user()->can('join-group', [$group])) {
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msg'=>'تنها اعضای گروه می توانند دیدگاه خود را برای این پست بیان نمایند.',
                'msgType'=>'danger',
                'returns'=> [
                    'num_comments'=>'',
                ]
            ];
        }
        $user = Auth::user();
        $comment = $post->comments()->create(['user_id'=>$user->id,'body'=>$request->input('body')]);
        $num_comments = $post->comments()->count();
        $post->update(['num_comment'=>$num_comments]);
        $this->groupStream($comment);
        return [
            'hasCallback'=>1,
            'callback'=>'post_comment',
            'hasMsg'=>0,
            'msg'=>'',
            'msgType'=>'',
            'returns'=> [
                'new_comment'=> view('partials.postComment', compact('user','comment','problem'))->render(),
                'num_comments'=>$num_comments
            ]
        ];
    }

    public function postGroupDelete(Request $request,Post $post, Comment $comment){
        if ($request->user()->cannot('delete-problem-comment', [$post, $comment])) {
            return [
                'hasCallback'=>0,
                'callback'=>'',
                'hasMsg'=>1,
                'msg'=>'شما مجوز حذف این پست را ندارید.',
                'msgType'=>'danger',
                'returns'=> [
                    'num_comments'=>'',
                ]
            ];
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

    public function postGroupUpdate(Request $request,Problem $problem, Comment $comment){
        if ($request->user()->cannot('update-post-comment', $comment)) {
            abort(403);
        }
        $comment->update(['body'=>$request->input('value')]);
    }

    private function groupStream(Comment $comment){
        $user = Auth::user();
        $owner = $comment->commentable->user;
        if($user->id != $owner->id){
            Stream::create([
                'user_id'=> $owner->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $comment->id,
                'contentable_type'=> 'App\Comment',
                'parentable_id'=>$user->id,
                'parentable_type'=>'App\Group',
                'is_see'=>0
            ]);
        }
    }

}
