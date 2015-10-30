<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 25/10/2015
 * Time: 11:47 AM
 */

namespace App\Repositories;


use App\Article;
use App\Endorse;
use App\Friend;
use App\Poll;
use App\Post;
use App\Questionnaire;
use App\Recommendation;
use App\Shop;
use App\Storage;
use Illuminate\Support\Facades\Auth;

class StreamRepository {
    private $feed = [];

    public function feed(){
        $user = Auth::user();
        foreach($user->streams()->latest()->get() as $stream){
            if($stream->contentable_type == 'App\Post'){
                $this->feed[] = $this->post($stream->contentable);
            }elseif($stream->contentable_type == 'App\Friend'){
                $this->feed[] = $this->friend($stream->contentable);
            }elseif($stream->contentable_type == 'App\Endorse'){
                $this->feed[] = $this->endorse($stream->contentable);
            }elseif($stream->contentable_type == 'App\Article'){
                $this->feed[] = $this->article($stream->contentable);
            }elseif($stream->contentable_type == 'App\Recommendation'){
                $this->feed[] = $this->recommendation($stream->contentable);
            }elseif($stream->contentable_type == 'App\Payment') {
                $payment = $stream->contentable;
                if($payment->itemable_type == 'App\Storage'){
                    $this->feed[] = $this->storage($payment->itemable);
                }elseif($payment->itemable_type == 'App\Poll'){
                    $this->feed[] = $this->poll($payment->itemable);
                }elseif($payment->itemable_type == 'App\Questionnaire'){
                    $this->feed[] = $this->questionnaire($payment->itemable);
                }elseif($payment->itemable_type == 'App\Shop'){
                    $this->feed[] = $this->shop($payment->itemable);
                }
            }
        }
        return $this->feed;
    }

    private function post(Post $post){
        return view('partials.postPreview', compact('post'))->render();
    }

    private function friend(Friend $friend){
        return view('streams.friend', compact('friend'))->render();
    }

    private function endorse(Endorse $endorse){
        return view('streams.endorse', compact('endorse'))->render();
    }

    private function article(Article $article){
        return view('streams.article', compact('article'))->render();
    }

    private function recommendation(Recommendation $recommendation){
        return view('streams.recommendation', compact('recommendation'))->render();
    }

    private function storage(Storage $storage){
        return view('streams.storage', compact('storage'))->render();
    }

    private function poll(Poll $poll){
        return view('streams.poll', compact('poll'))->render();
    }

    private function shop(Shop $shop){
        return view('streams.shop', compact('shop'))->render();
    }

    private function questionnaire(Questionnaire $questionnaire){
        return view('streams.questionnaire', compact('questionnaire'))->render();
    }

}