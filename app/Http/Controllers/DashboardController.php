<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Skill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user=Auth::user();
        $skillSelect=[];
        $skillSelect[0]='همه';
        foreach($user->skills()->get() as $skill){
            $skillSelect[$skill->id]=$skill->title;
        }

        //bindings
        $bind=new \stdClass();
        $bind->skill_id=$request->input('skill_id');

        //calculate the donut chart parameters (problem-answers)
        $answers=$user->comments()->where('commentable_type','App\Problem')->get();
        $countAnswer=0;
        $countTrueAnswer=0;
        foreach($answers as $answer){
            $countAnswer++;
            if($answer->commentable()->where('comment_id',$answer->id)->exists()){
                $countTrueAnswer++;
            }
        }
        $falseAnswer=$countAnswer-$countTrueAnswer;

        // corporation chart statistics
        $corporationStatistics=$this->corporationChartStatistics($user,$request);
        $numCorporation=$corporationStatistics['numCorporation'];
        $numNoCorporation=$corporationStatistics['numVisit']-$numCorporation;

        // rate chart statistics
        $rateResults=$this->rateChartStatistics($user,$request);

        //corporation questions statistics
        $corporationQuestionStatistics=$this->questionnaireStatistics($user,$request);



        return view('profile.dashboard.index')->with([
            'title'=>'داشبورد',
            'skillSelect'=>$skillSelect,
            'trueAnswer'=>$countTrueAnswer,
            'falseAnswer'=>$falseAnswer,
            'numCorporation'=>$numCorporation,
            'numNoCorporation'=>$numNoCorporation,
            'rateResults'=>$rateResults,
            'corporationQuestion'=>$corporationQuestionStatistics,
            'bind'=>$bind
        ]);


    }

    /**
     * Created By Dara on 16/12/2015
     * return the corporation chart statistics
     */
    private function corporationChartStatistics($user,Request $request){
        $numVisit=$user->profileVisits()->count();
        if($request->has('skill_id') && $request->input('skill_id')!=0){ //specific skill has been selected
            $this->validate($request,[
                'skill_id'=>'required|integer'
            ]);
            $skill=$user->skills()->findOrFail($request->input('skill_id'));
            $numCorporation=$skill->corporations()->where('question_completed',1)->count();
        }else{
            $numCorporation=$user->corporations()->where('question_completed',1)->count();
        }
        return [
            'numVisit'=>$numVisit,
            'numCorporation'=>$numCorporation
        ];
    }

    /**
     * Created By Dara on 16/12/2015
     * get user or skill rate statistics
     */
    private function rateChartStatistics($user,Request $request){
        if($request->has('skill_id') && $request->input('skill_id')!=0){ //specific skill has been selected
            $this->validate($request,[
                'skill_id'=>'required|integer'
            ]);
            $skill=$user->skills()->findOrFail($request->input('skill_id'));
            $rateResult=[];
            foreach($skill->rate()->get() as $rate ){
                $rateResult[]=$rate;
            }

        }else{
            // no specific skill has been selected
            $rateResult=[];
            foreach($user->rate()->get() as $rate){
                $rateResult[]=$rate;
            }


        }

        return $rateResult;
    }

    /**
     * Created By Dara on 16/12/2015
     * get corporation questionnaire statistics
     */
    private function questionnaireStatistics($user,$request){
        if($request->has('skill_id') && $request->input('skill_id')!=0){ //specific skill has been selected
            $this->validate($request,[
                'skill_id'=>'required|integer'
            ]);
            $stats=[];
            $skill=$user->skills()->findOrFail($request->input('skill_id'));
            $corporationQuery=$skill->corporations()->where('question_completed',1);
            $corporations=$corporationQuery->get();
            $corporationNum=$corporationQuery->count();
            foreach($corporations as $corporation){
                $answers=$corporation->answers()->get();
                foreach($answers as $answer){
                    $stats[$corporation->id][$answer->question->id]=(6-$answer->answer)/$corporationNum;
                }
            }
            $m=[]; //array where the key is the id of the question and value the avg point (1-5)
            $m[1]=0; //first question
            $m[2]=0;
            $m[3]=0;
            $m[4]=0;
            $m[5]=0; //last question
            foreach($stats as $key=>$stat){
                foreach($stat as $index=>$value){
                    $m[$index]+=$value;
                }
            }
            return $m;
        }else{
            // no specific skill has been selected
            $skills=$user->skills()->get();
            $stats=[];
            foreach($skills as $skill){
                $corporationQuery=$skill->corporations()->where('question_completed',1);
                $corporations=$corporationQuery->get();
                $corporationNum=$corporationQuery->count();
                foreach($corporations as $corporation){
                    $answers=$corporation->answers()->get();
                    foreach($answers as $answer){
                        $stats[$corporation->id][$answer->question->id]=(6-$answer->answer)/$corporationNum;
                    }
                }
            }
            //dd($stats);

            $m=[]; //array where the key is the id of the question and value the avg point (1-5)
            $m[1]=0; //first question
            $m[2]=0;
            $m[3]=0;
            $m[4]=0;
            $m[5]=0; //last question
            foreach($stats as $key=>$stat){
                foreach($stat as $index=>$value){
                    $m[$index]+=$value;
                }
            }
        }
        return $m;
    }
}
