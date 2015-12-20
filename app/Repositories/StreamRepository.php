<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 25/10/2015
 * Time: 11:47 AM
 */

namespace App\Repositories;


use App\Article;
use App\Corporation;
use App\Endorse;
use App\Friend;
use App\Group;
use App\Offer;
use App\Poll;
use App\Post;
use App\Problem;
use App\Profit;
use App\Questionnaire;
use App\Recommendation;
use App\Relater;
use App\Shop;
use App\Showcase;
use App\Storage;
use App\Stream;
use Illuminate\Support\Facades\Auth;

class StreamRepository {
    private $feed = [];

    public function feed(){
        $user = Auth::user();
//        Ahmad Dara Suggestion
//        foreach($user->streams()->latest()->where('parentable_type','App\User')->get() as $stream){
        foreach($user->streams()->latest()->get() as $stream){
            if($stream->contentable_type == 'App\Post'){
                $this->feed[] = $this->post($stream->contentable);
            }elseif($stream->contentable_type == 'App\Friend'){
                $contentable = $stream->contentable;
                if($contentable){
                    $this->feed[] = $this->friend($contentable);
                }
            }elseif($stream->contentable_type == 'App\Endorse'){
                $this->feed[] = $this->endorse($stream->contentable);
            }elseif($stream->contentable_type == 'App\Article'){
                $this->feed[] = $this->article($stream->contentable);
            }elseif($stream->contentable_type == 'App\Recommendation'){
                $this->feed[] = $this->recommendation($stream->contentable);
            }elseif($stream->contentable_type == 'App\Problem'){
                $this->feed[] = $this->problem($stream->contentable);
            }elseif($stream->contentable_type == 'App\Poll'){
                $this->feed[] = $this->pollPreview($stream->contentable);
            }elseif($stream->contentable_type == 'App\Questionnaire') {
                $this->feed[] = $this->questionnairePreview($stream->contentable);
            }elseif($stream->contentable_type=='App\Corporation'){
                $this->feed[]=$this->corporation($stream->contentable);
            }elseif($stream->contentable_type=='App\Showcase'){
                $contentable = $stream->contentable;
                if($contentable){
                    $this->feed[]=$this->showcaseProccess($stream->contentable, $stream);
                }
            }elseif($stream->contentable_type == 'App\Payment') {
                $payment = $stream->contentable;
                if ($payment->itemable_type == 'App\Storage') {
                    $this->feed[] = $this->storage($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Poll') {
                    $this->feed[] = $this->poll($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Questionnaire') {
                    $this->feed[] = $this->questionnaire($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Shop') {
                    $this->feed[] = $this->shop($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Offer') {
                    $this->feed[] = $this->offer($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Relater') {
                    $this->feed[] = $this->relater($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Profit') {
                    $this->feed[] = $this->profit($payment->itemable);
                } elseif ($payment->itemable_type == 'App\Showcase') {
                    $itemable = $payment->itemable;
                    if($itemable){
                        $this->feed[] = $this->showcase($payment->itemable);
                    }
                }
            }
        }
        return $this->feed;
    }

    public function group($group){
        $user=Auth::user();
        $streams = Stream::where('parentable_type','App\Group')
            ->where('parentable_id', $group->id)
            ->where('user_id',$user->id)
            ->latest()
            ->get();
        foreach($streams as $stream){
            if($stream->contentable_type == 'App\Post'){
                $this->feed[] = $this->postGroup($stream->contentable);
            }elseif($stream->contentable_type == 'App\Problem'){
                $this->feed[] = $this->problem($stream->contentable);
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

    /**
     * Created By Dara on 2/11/2015
     * handling the stream view related to the group
     */
    private function problem(Problem $problem){
        return view('partials.problemPreview', compact('problem'))->render();
    }

    private function postGroup(Post $post){
        return view('partials.postGroupPreview',compact('post'))->render();
    }

    /**
     * Created By Dara on 5/11/2015
     * handling the stream view related to special offer
     */
    private function offer(Offer $offer){
        return view('streams.offer', compact('offer'))->render();
    }

    /**
     * Created By Dara on 1/12/2015
     * handling the stream view related to corporation
     */
    private function corporation(Corporation $corporation){
        $user=Auth::user();
        if($user->id==$corporation->sender_id){ //the current user is the one who made the request
            if($corporation->status==1){ //his/her request has been approved
                return view('streams.acceptanceCorporation',compact('corporation'))->render();
            }elseif($corporation->status==0){ //his/her request has been denied
                //
            }
        }elseif($user->id==$corporation->receiver_id){ //the current user is the one who receives the request
            return view('streams.corporation',compact('corporation'))->render();
        }
    }


    /**
     * Created By Dara on 27/11/2015
     * handling the stream view related to the relater addon
     */
    public function relater(Relater $relater){
        return view('streams.relater', compact('relater'))->render();
    }

    /**
     * Created By Dara on 29/11/2015
     * handling the stream view related to the profit addon
     */
    private function profit(Profit $profit){
        return view('streams.profit',compact('profit'))->render();
    }

    private function pollPreview(Poll $poll){
        $parameters = $poll->parameters()->get();
        $total_votes = $parameters->sum('num_vote');
        if($total_votes == 0) $total_votes=1;
        return view('partials.pollPreview', compact('poll', 'parameters', 'total_votes'))->render();
    }

    private function questionnairePreview(Questionnaire$questionnaire){
        return view('partials.questionnairePreview', compact('questionnaire'));
    }

    public function showcase(Showcase $showcase){
        return view('streams.showcase', compact('showcase'));
    }

    public function showcaseProccess(Showcase $showcase, Stream $stream){
        if($stream->parentable_id == $showcase->user_id){
            return view('streams.showcaseRequest', compact('showcase'));
        }elseif($stream->parentable_id == $showcase->profile_id){
            return view('streams.showcaseApproved', compact('showcase'));
        }
    }
}