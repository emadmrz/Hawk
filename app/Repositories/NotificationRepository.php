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
use App\Corporation;
use App\Endorse;
use App\Post;
use App\Problem;
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
            if($stream->parentable_type=='App\User'){
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
            }elseif($stream->contentable_type=='App\Corporation'){
                $this->notification[]=$this->corporation($stream->contentable);
            }
            }elseif($stream->parentable_type=='App\Group'){
                if($stream->contentable_type=='App\Problem'){
                    $this->notification[]=$this->problem($stream->contentable);
                }elseif($stream->contentable_type=='App\Comment'){
                    $comment=$stream->contentable;
                    if($comment->commentable_type=='App\Problem'){
                        $this->notification[]=$this->problemComment($comment->commentable,$comment);
                    }elseif($comment->commentable_type=='App\Post'){
                        $this->notification[]=$this->postGroupComment($comment->commentable,$comment);
                    }
                }elseif($stream->contentable_type=="App\Post"){
                    $this->notification[]=$this->postGroup($stream->contentable);
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

    /**
     * Created By Dara on 4/11/2015
     * handling the group notifications
     */
    private function problem(Problem $problem){
        return view('notifications.problem', compact('problem'))->render();
    }

    private function problemComment(Problem $problem,Comment $comment){
        return view('notifications.problemComment',compact('problem','comment'))->render();
    }

    private function postGroup(Post $post){
        return view('notifications.postGroup',compact('post'))->render();
    }

    private function postGroupComment(Post $post, Comment $comment){
        return view('notifications.postGroupComment', compact('post','comment'))->render();
    }

    /**
     * Created By Dara on 1/12/2015
     * handling the corporation notification
     */
    private function corporation(Corporation $corporation){
        $user=Auth::user();
        if($user->id==$corporation->sender_id){ //the current user is the one who made the request
            if($corporation->status==1){ //his/her request has been approved
                return view('notifications.acceptanceCorporation',compact('corporation'))->render();
            }elseif($corporation->status==0){ //his/her request has been denied
                //
            }
        }elseif($user->id==$corporation->receiver_id){ //the current user is the one who receives the request
            return view('notifications.corporation',compact('corporation'))->render();
        }
    }


}