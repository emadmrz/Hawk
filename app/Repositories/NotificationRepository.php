<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 26/10/2015
 * Time: 11:37 AM
 */

namespace App\Repositories;


use App\Article;
use App\Comment;
use App\Endorse;
use App\Post;
use App\Recommendation;
use App\User;
use Illuminate\Support\Facades\Auth;

class NotificationRepository {

    private $notification = [];

    public function count(){
        $user = Auth::user();
        $count = $user->streams()->unseen()->notifier()->count();
        return $count;
    }

    public function newList(){
        $user = Auth::user();
        $stream = $user->streams()->unseen()->notifier();
        $streams = $stream->latest()->get();
        $stream->update(['is_see'=>1]);
        return $streams;
    }

    public function notifications(){
        $user = Auth::user();
        $streams = $this->newList();
        foreach($streams as $stream){
            if($stream->contentable_type == 'App\Post'){
                $this->notification[] = $this->post($stream->contentable);
            }elseif($stream->contentable_type == 'App\Article'){
                $this->notification[] = $this->article($stream->contentable);
            }elseif($stream->contentable_type == 'App\Endorse'){
                $this->notification[] = $this->endorse($stream->contentable, $user);
            }elseif($stream->contentable_type == 'App\Recommendation'){
                $this->notification[] = $this->recommendation($stream->contentable, $user);
            }
            elseif($stream->contentable_type == 'App\Comment'){
                $comment = $stream->contentable;
                if($comment->commentable_type == 'App\Post'){
                    $this->notification[] = $this->postComment($comment->commentable, $comment);
                }elseif($comment->commentable_type == 'App\Article'){
                $this->notification[] = $this->articleComment($comment->commentable, $comment);
                }
            }

        }
        return $this->notification;
    }

    private function post(Post $post){
        return view('notifications.post', compact('post'))->render();
    }

    private function postComment(Post $post, Comment $comment){
        return view('notifications.postComment', compact('post','comment'))->render();
    }

    private function article(Article $article){
        return view('notifications.article', compact('article'))->render();
    }

    private function articleComment(Article $article, Comment $comment){
        return view('notifications.articleComment', compact('article','comment'))->render();
    }

    private function endorse(Endorse $endorse, User $user){
        return view('notifications.endorse', compact('endorse', 'user'))->render();
    }

    private function recommendation(Recommendation $recommendation, User $user){
        return view('notifications.recommendation', compact('recommendation', 'user'))->render();
    }

}