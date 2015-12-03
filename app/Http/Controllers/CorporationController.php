<?php

namespace App\Http\Controllers;

use App\Corporation;
use App\CorporationAnswer;
use App\CorporationQuestionnaire;
use App\Skill;
use App\Stream;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class CorporationController extends Controller
{
    public function create(User $profile,Skill $skill){
        $user=Auth::user();
        $sender_id=$user->id;
        $receiver_id=$profile->id;
        $skill_id=$skill->id;
        $found=Corporation::where('sender_id',$user->id)->where('receiver_id',$receiver_id)->where('skill_id',$skill_id)->exists();
        if($found){ //corporation already exists
            Flash::error(trans('messages.corporationExists'));
        }else{
            $corporation=Corporation::create([
                'sender_id'=>$sender_id,
                'receiver_id'=>$receiver_id,
                'skill_id'=>$skill_id,
            ]);
            $this->stream($corporation,$receiver_id);
            Flash::success(trans('messages.corporationCreated'));
        }
        return redirect()->back();
    }

    public function index(Corporation $corporation){
        $user=Auth::user();
        return view('profile.corporation.index',compact('corporation','user'))->with(['title'=>'همکاری']);
    }

    public function showAll(){
        $user=Auth::user();
        $corporations=$user->corporations()->latest()->get();
        $myCorporations=$user->myCorporations()->latest()->get();
        return view('profile.corporation.show',compact('corporations','myCorporations','user'))->with(['title'=>'درخواست های همکاری']);
    }

    public function submit(Request $request,Corporation $corporation){
        $this->validate($request,[
            'status'=>'in:0,1'
        ]);
        if($corporation->question_completed==1){ //because the questions has been answered u cant edit this part
            return redirect()->back();
        }
        $status=$request->input('status');
        if($status==0){ //the user denied the corporation
            $corporation->update(['status'=>0]);
            Flash::success(trans('corporationDenied'));
        }elseif($status==1){ //the user has submitted the corporation request
            $corporation->update(['status'=>1]);
            $this->acceptanceStream($corporation,$corporation->sender_id,$corporation->receiver_id);
            Flash::success(trans('corporationAccepted'));
        }
        return redirect(route('profile.corporation.list'));
    }

    /**
     * Created By Dara on 1/12/2015
     * create the stream for requesting a corporation
     */
    private function stream($corporation,$receiverId){
        Stream::create([
            'user_id'=>$receiverId,
            'edge_rank'=> 0,
            'contentable_id'=> $corporation->id,
            'contentable_type'=> 'App\Corporation',
            'parentable_id'=>$receiverId,
            'parentable_type'=>'App\User',
            'is_see'=>0
        ]);
    }

    /**
     * Created By Dara on 1/12/2015
     * create the stream after submitting a corporation
     */
    private function acceptanceStream($corporation,$senderId){
        Stream::create([
            'user_id'=>$senderId,
            'edge_rank'=> 0,
            'contentable_id'=> $corporation->id,
            'contentable_type'=> 'App\Corporation',
            'parentable_id'=>$senderId,
            'parentable_type'=>'App\User',
            'is_see'=>0
        ]);
    }

    /**
     * Created By Dara on 1/12/2015
     * the questions form index
     */
    public function questionIndex(Corporation $corporation){
        $questions=CorporationQuestionnaire::all();
        return view('profile.corporation.question.index',compact('corporation','questions'))->with(['title'=>'تکمیل پرسشنامه']);
    }

    /**
     * Created By Dara on 1/12/2015
     * the questions form submit
     */
    public function questionSubmit(Request $request,Corporation $corporation){
        $input=$request->except(['_token']);
        if($corporation->question_completed==1){ //the corporation has been answered before
            Flash::error(trans('messages.corporationQuestionAnsweredAlready'));
            return redirect()->back();
        }
        $query=CorporationQuestionnaire::all();
        $questionCount=$query->count();
        $filledCount=count($input);
        if($questionCount==$filledCount){ //all questions has been answered
            foreach($query as $question){
                CorporationAnswer::create([
                    'corporation_id'=>$corporation->id,
                    'question_id'=>$question->id,
                    'answer'=>$input["status".$question->id]
                ]);
            }
            $corporation->update(['question_completed'=>1]);
            Flash::success(trans('messages.corporationQuestionAnswered'));
            return redirect(route('profile.corporation.list',[$corporation->id]));
        }else{ //missing answers
            Flash::error(trans('messages.corporationQuestionMissing'));
            return redirect()->back();
        }
    }

    /**
     * Created By Dara on 1/12/2015
     * show the answer of a corporation question form
     */
    public function questionShow(Corporation $corporation){
        $answers=$corporation->answers()->get();
        return view('profile.corporation.question.show',compact('answers'))->with(['title'=>'مشاهده پرسشنامه']);
    }
}
