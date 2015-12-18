<?php

namespace App\Http\Controllers;

use App\Category;
use App\Rate;
use App\Repositories\ProfileProgressRepository;
use App\Skill;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class RateController extends Controller
{
    /**
     * Created by Dara on 8/12/2015
     * the staration index page
     */
    public function index(){
        $users=User::with('roles')->paginate(20);
        $latestRatings=Rate::latest()->first();
        return view('admin.staration.index',compact('users','latestRatings'))->with(['title'=>'Users Rating']);
    }

    /**
     * Created By Dara on 8/12/2015
     * the staration skill index page
     */
    public function skillIndex(User $user){
        $skills=$user->skills()->paginate(20);
        return view('admin.staration.skillIndex',compact('skills'))->with(['title'=>'Skills Rating']);
    }

    public function rate(ProfileProgressRepository $profileProgressRepository){
        foreach(User::all() as $user){
            //calculate the rate for skill
            $maxSkillStar=$this->skillRate($user); //insert the skill rate in database and return the max skill rate foreach user

            //calculate the rate for user

            //calculate the profile progress point
            $finalProfilePoint=$this->profile($user,$profileProgressRepository);

            //calculate the answers point
            $finalAnswerPoint=$this->answer($user);

            //calculate the profile visits
            $finalProfileVisitPoint=$this->profileVisit($user);

            //calculate the share point foreach user
            $finalSharePoint=$this->share($user);

            //calculate the total each user parameters point
            $totalUserPoint=$finalProfilePoint+$finalAnswerPoint+$finalProfileVisitPoint+$finalSharePoint;
            $finalUserPoint=0;
            $calculatedUserPoint=$totalUserPoint/(Config::get('rate')['profile']['weight']+Config::get('rate')['answer']['weight']+Config::get('rate')['profileVisit']['weight']+Config::get('rate')['share']['weight']);
            if($calculatedUserPoint>Config::get('rate')['skill']['result'][5]){ //5 star skill
                $finalUserPoint=Config::get('rate')['skill']['result'][5]['output'];
            }elseif($calculatedUserPoint>Config::get('rate')['user']['result'][4] && $calculatedUserPoint<=Config::get('rate')['user']['result'][5]){
                $finalUserPoint=Config::get('rate')['skill']['result'][4]['output'];
            }elseif($calculatedUserPoint>Config::get('rate')['user']['result'][3] && $calculatedUserPoint<=Config::get('rate')['user']['result'][4]){
                $finalUserPoint=Config::get('rate')['skill']['result'][3]['output'];
            }elseif($calculatedUserPoint>Config::get('rate')['user']['result'][2] && $calculatedUserPoint<=Config::get('rate')['user']['result'][3]){
                $finalUserPoint=Config::get('rate')['skill']['result'][2]['output'];
            }elseif($calculatedUserPoint>=Config::get('rate')['user']['result'][1] && $calculatedUserPoint<=Config::get('rate')['user']['result'][2]){
                $finalUserPoint=Config::get('rate')['skill']['result'][1]['output'];
            }

            //finally the user star
            $userStar=$finalUserPoint+$maxSkillStar[$user->id];
            if($userStar>5){
                $userStar=5;
            }elseif($userStar<1){
                $userStar=1;
            }

            //insert the user star in users table
            $user->update(['rate'=>$userStar]);

            //insert the user star in rates table
            $userRate=$user->rate();
            if($userRate->exists()){
                $user->update([
                    'rate'=>$userStar
                ]);
            }else{
                $userRate->create([
                    'rate'=>$userStar
                ]);
            }
            
        } //end of users foreach
        return redirect()->back();
    }

    /**
     * Created By Dara on 8/12/2015
     * calculate the skill rate
     */
    private function skillRate($user){
        $maxSkillStar=[];
        $skillStar=[];
        $skills=$user->skills;
        foreach($skills as $num=>$skill){
            //endorse checking
            $finalEndorsePoint=$this->endorse($skill);

            //recommendation checking
            $finalRecommendationPoint=$this->recommendation($skill);

            //checking self-opinion
            $finalOpinionPoint=$this->opinion($skill);

            //checking experiences
            $finalExperiencePoint=$this->experience($skill);

            //checking degrees
            $finalDegreePoint=$this->degree($skill);

            //checking corporations
            $mixCorporation=$this->corporation($skill);
            $finalCorporationPoint=$mixCorporation['finalCorporationPoint'];
            $finalJobPoint=$mixCorporation['finalJobPoint'];

            //checking books and articles
            $finalPaperPoint=$this->paper($skill);

            //checking histories
            $finalHistoryPoint=$this->history($skill);

            //calculate the total each skill point
            $totalSkillPoint=$finalEndorsePoint+
                $finalRecommendationPoint+
                $finalOpinionPoint+
                $finalExperiencePoint+
                $finalDegreePoint+
                $finalCorporationPoint+
                $finalJobPoint+
                $finalPaperPoint+
                $finalHistoryPoint;
            //between 1-5
            $calculatedSkillPoint=$totalSkillPoint/(Config::get('rate')['endorse']['weight']+Config::get('rate')['recommendation']['weight']+Config::get('rate')['opinion']['weight']+Config::get('rate')['experience']['weight']+Config::get('rate')['degree']['weight']+Config::get('rate')['corporation']['weight']+Config::get('rate')['job']['weight']+Config::get('rate')['paper']['weight']+Config::get('rate')['history']['weight']);
            if($calculatedSkillPoint>Config::get('rate')['skill']['result'][5]){ //5 star skill
                $finalSkillPoint=5;
            }elseif($calculatedSkillPoint>Config::get('rate')['skill']['result'][4] && $calculatedSkillPoint<=Config::get('rate')['skill']['result'][5]){
                $finalSkillPoint=4;
            }elseif($calculatedSkillPoint>Config::get('rate')['skill']['result'][3] && $calculatedSkillPoint<=Config::get('rate')['skill']['result'][4]){
                $finalSkillPoint=3;
            }elseif($calculatedSkillPoint>Config::get('rate')['skill']['result'][2] && $calculatedSkillPoint<=Config::get('rate')['skill']['result'][3]){
                $finalSkillPoint=2;
            }elseif($calculatedSkillPoint>=Config::get('rate')['skill']['result'][1] && $calculatedSkillPoint<=Config::get('rate')['skill']['result'][2]){
                $finalSkillPoint=1;
            }else{
                $finalSkillPoint=1;
            }
            $skillStar[$skill->id]=$finalSkillPoint; //between 1-5 the key is the skill id while the value is the rate

            //insert the skill rate in skills table
            $skill->update(['rate'=>$finalSkillPoint]);

            //insert the skill rate in rates table
            $skillRate=$skill->rate();
            if($skillRate->exists()){
                $skillRate->update([
                    'rate'=>$finalSkillPoint
                ]);
            }else{
                $skillRate->create([
                    'rate'=>$finalSkillPoint
                ]);
            }

        }//end of skills foreach

        //get max skill rate for the specified user
        $maxSkillStar[$user->id]=max($skillStar);
        return $maxSkillStar;
    }

    /**
     * Created By Dara on 6/12/2015
     * calculate the endorse point
     */
    private function endorse($skill){
        $finalEndorsePoint=0;
        $secondSkillCategory=Category::find($skill->sub_category_id);
        $firstSkillCategory=$secondSkillCategory->parent()->first();
        $thirdSkillCategory=$skill->tags; //array of tags
        $endorserResults = [];
        $endorserPoint=0;
        foreach($skill->endorses as $endorse){
            $endorser=$endorse->user;
            $endorserSkills=$endorser->skills;
            $endorserLevel = 0;
            $endorserSkillLevel =1;
            if(!$endorserSkills->isEmpty()){ //the endorser has at least on skill
                foreach($endorserSkills as $endorserSkill){
                    $endorserSkillTags = $endorserSkill->tags;
                    if(!empty(array_intersect($endorserSkillTags->lists('id')->toArray(), $thirdSkillCategory->lists('id')->toArray()))){
                        //all categories is similar
                        $endorserLevel = 3;
                        $endorserSkillLevel = $endorserSkill->rate;
                    }elseif($endorserSkill->sub_category_id == $secondSkillCategory->id){
                        //second and first are similar
                        if($endorserLevel < 3){
                            $endorserLevel = 2;
                            $endorserSkillLevel = $endorserSkill->rate;
                        }
                    }elseif(Category::find($endorserSkill->sub_category_id)->parent_id == $firstSkillCategory->id){
                        //only first category is similar
                        if($endorserLevel < 2){
                            $endorserLevel = 1;
                            $endorserSkillLevel = $endorserSkill->rate;
                        }
                    }else{
                        if($endorserLevel < 1){
                            $endorserLevel = 0;
                            $endorserSkillLevel = $endorser->rate;
                        }
                    }
                }
                $endorserResults[] = ['endorser_id'=>$endorser->id, 'endorser_skill_level'=>$endorserSkillLevel, 'endorser_level'=>$endorserLevel,'skill_id'=>$skill->id];
            }else{
                $endorserResults[] = ['endorser_id'=>$endorser->id, 'endorser_skill_level'=>1, 'endorser_level'=>0,'skill_id'=>$skill->id];
            }
            //calculate the endorse points
            //var_dump($endorserResults);
            foreach($endorserResults as $endorserResult){
                $endorserPoint+=Config::get('rate')['endorse']['attributes'][$endorserResult['endorser_level']]['conditions'][$endorserResult['endorser_skill_level']]['value'];
            }

            //finalize the endorse calculation points
            if($endorserPoint>Config::get('rate')['endorse']['result'][5]){ //5 star
                $calculatedEndorsePoint=5;
            }elseif($endorserPoint>Config::get('rate')['endorse']['result'][4] && $endorserPoint<=Config::get('rate')['endorse']['result'][5]){ //4 star
                $calculatedEndorsePoint=4;
            }elseif($endorserPoint>Config::get('rate')['endorse']['result'][3] && $endorserPoint<=Config::get('rate')['endorse']['result'][4]){ //3 star
                $calculatedEndorsePoint=3;
            }elseif($endorserPoint>Config::get('rate')['endorse']['result'][2] && $endorserPoint<=Config::get('rate')['endorse']['result'][3]){ //2 star
                $calculatedEndorsePoint=2;
            }elseif($endorserPoint>=Config::get('rate')['endorse']['result'][1] && $endorserPoint<=Config::get('rate')['endorse']['result'][2]){ //1 star
                $calculatedEndorsePoint=1;
            }else{ //none star
                $calculatedEndorsePoint=1;
            }
            $finalEndorsePoint+=$calculatedEndorsePoint*Config::get('rate')['endorse']['weight'];
        }
        return $finalEndorsePoint;

    }

    /**
     * Created By Dara on 7/12/2015
     * recommendation checking
     */
    private function recommendation($skill){
        $recommendationPoint=0;
        $recommendationPointFive=0;
        $recommendationPointFour=0;
        $recommendationPointThree=0;
        $recommendationPointTwo=0;
        $recommendationPointOne=0;
        $recommendations=$skill->recommendations;
        foreach($recommendations as $recommendation){
            $recommendator=$recommendation->user;
            $rate=$recommendator->rate;
            if($rate==5){
                $recommendationPointFive+=Config::get('rate')['recommendation']['attributes'][$rate]['value'];
                if($recommendationPointFive>=Config::get('rate')['recommendation']['attributes'][$rate]['max_value']){
                    $recommendationPointFive=Config::get('rate')['recommendation']['attributes'][$rate]['max_value'];
                }
            }elseif($rate==4){
                $recommendationPointFour+=Config::get('rate')['recommendation']['attributes'][$rate]['value'];
                if($recommendationPointFour>=Config::get('rate')['recommendation']['attributes'][$rate]['max_value']){
                    $recommendationPointFour=Config::get('rate')['recommendation']['attributes'][$rate]['max_value'];
                }
            }elseif($rate==3){
                $recommendationPointThree+=Config::get('rate')['recommendation']['attributes'][$rate]['value'];
                if($recommendationPointThree>=Config::get('rate')['recommendation']['attributes'][$rate]['max_value']){
                    $recommendationPointThree=Config::get('rate')['recommendation']['attributes'][$rate]['max_value'];
                }
            }elseif($rate==2){
                $recommendationPointTwo+=Config::get('rate')['recommendation']['attributes'][$rate]['value'];
                if($recommendationPointTwo>=Config::get('rate')['recommendation']['attributes'][$rate]['max_value']){
                    $recommendationPointTwo=Config::get('rate')['recommendation']['attributes'][$rate]['max_value'];
                }
            }elseif($rate==1){
                $recommendationPointOne+=Config::get('rate')['recommendation']['attributes'][$rate]['value'];
                if($recommendationPointOne>=Config::get('rate')['recommendation']['attributes'][$rate]['max_value']){
                    $recommendationPointOne=Config::get('rate')['recommendation']['attributes'][$rate]['max_value'];
                }
            }
            $recommendationPoint=$recommendationPointFive+$recommendationPointFour+$recommendationPointThree+$recommendationPointTwo+$recommendationPointOne;
        }
        //finalize the recommendation calculation points
        if($recommendationPoint>Config::get('rate')['recommendation']['result'][5]){ //5 star
            $calculatedRecommendationPoint=5;
        }elseif($recommendationPoint>Config::get('rate')['recommendation']['result'][4] && $recommendationPoint<=Config::get('rate')['recommendation']['result'][5]){ //4 star
            $calculatedRecommendationPoint=4;
        }elseif($recommendationPoint>Config::get('rate')['recommendation']['result'][3] && $recommendationPoint<=Config::get('rate')['recommendation']['result'][4]){ //3 star
            $calculatedRecommendationPoint=3;
        }elseif($recommendationPoint>Config::get('rate')['recommendation']['result'][2] && $recommendationPoint<=Config::get('rate')['recommendation']['result'][3]){ //2 star
            $calculatedRecommendationPoint=2;
        }elseif($recommendationPoint>=Config::get('rate')['recommendation']['result'][1] && $recommendationPoint<=Config::get('rate')['recommendation']['result'][2]){ //1 star
            $calculatedRecommendationPoint=1;
        }else{ //none star
            $calculatedRecommendationPoint=1;
        }
        $finalRecommendationPoint=$calculatedRecommendationPoint*Config::get('rate')['recommendation']['weight'];
        return $finalRecommendationPoint;
    }

    /**
     * Created By Dara on 7/12/2015
     * checking self-opinion
     */
    private function opinion($skill){
        if($skill->my_rate==1){ //5 star
            $calculatedOpinionPoint=5;
        }elseif($skill->my_rate==2){ //3 star
            $calculatedOpinionPoint=3;
        }elseif($skill->my_rate==3){ //1 star
            $calculatedOpinionPoint=1;
        }else{
            $calculatedOpinionPoint=1;
        }
        $finalOpinionPoint=$calculatedOpinionPoint*Config::get('rate')['opinion']['weight'];
        return $finalOpinionPoint;
    }

    /**
     * Created By Dara on 7/12/2015
     * checking experience
     */
    private function experience($skill){
        $count=[];
        $calculatedExperiencePoint=0;
        foreach($skill->experiences as $key=>$experience){
            $countLike=$experience->num_like;
            $countDisLike=$experience->num_dislike;
            $count[$key]=($countLike*Config::get('rate')['experience']['attributes']['like'])-($countDisLike*Config::get('rate')['experience']['attributes']['dislike']);
            $count[$key]+=Config::get('rate')['experience']['attributes']['experience'];
        }
        $experiencePoint=array_sum($count);
        if($experiencePoint>Config::get('rate')['experience']['result'][5]){ //5 star experience
            $calculatedExperiencePoint=5;
        }elseif($experiencePoint>Config::get('rate')['experience']['result'][4] && $experiencePoint<=Config::get('rate')['experience']['result'][5]){
            $calculatedExperiencePoint=4;
        }elseif($experiencePoint>Config::get('rate')['experience']['result'][3] && $experiencePoint<=Config::get('rate')['experience']['result'][4]){
            $calculatedExperiencePoint=3;
        }elseif($experiencePoint>Config::get('rate')['experience']['result'][2] && $experiencePoint<=Config::get('rate')['experience']['result'][3]){
            $calculatedExperiencePoint=2;
        }elseif($experiencePoint>=Config::get('rate')['experience']['result'][1] && $experiencePoint<=Config::get('rate')['experience']['result'][2]){
            $calculatedExperiencePoint=1;
        }
        $finalExperiencePoint=$calculatedExperiencePoint*Config::get('rate')['experience']['weight'];
        return $finalExperiencePoint;
    }

    /**
     * Created By Dara on 7/12/2015
     * checking degree
     */
    private function degree($skill){
        $count=[];
        $calculatedDegreePoint=0;
        foreach($skill->degrees as $key=>$degree){
            $countLike=$degree->num_like;
            $countDisLike=$degree->num_dislike;
            $count[$key]=($countLike*Config::get('rate')['degree']['attributes']['like'])-($countDisLike*Config::get('rate')['degree']['attributes']['dislike']);
            $count[$key]+=Config::get('rate')['degree']['attributes']['degree'];
        }
        $degreePoint=array_sum($count);
        if($degreePoint>Config::get('rate')['degree']['result'][5]){ //5 star degree
            $calculatedDegreePoint=5;
        }elseif($degreePoint>Config::get('rate')['degree']['result'][4] && $degreePoint<=Config::get('rate')['degree']['result'][5]){
            $calculatedDegreePoint=4;
        }elseif($degreePoint>Config::get('rate')['degree']['result'][3] && $degreePoint<=Config::get('rate')['degree']['result'][4]){
            $calculatedDegreePoint=3;
        }elseif($degreePoint>Config::get('rate')['degree']['result'][2] && $degreePoint<=Config::get('rate')['degree']['result'][3]){
            $calculatedDegreePoint=2;
        }elseif($degreePoint>=Config::get('rate')['degree']['result'][1] && $degreePoint<=Config::get('rate')['degree']['result'][2]){
            $calculatedDegreePoint=1;
        }
        $finalDegreePoint=$calculatedDegreePoint*Config::get('rate')['experience']['weight'];
        return $finalDegreePoint;
    }

    /**
     * Created By Dara on7/12/2015
     * corporation checking (num+reputation)
     */
    private function corporation($skill){
        $calculatedJobPoint=0;
        $parameterAvg=[];
        $index=0;
        $corporations=$skill->corporations();
        foreach($corporations->where('question_completed',1)->get() as $index=>$corporation){
            $parameters=$corporation->answers->lists('answer');
            $parameterCount=0;
            foreach($parameters as $key=>$parameter){
                if($parameter==1){
                    $parameterCount+=Config::get('rate')['corporation']['attributes'][$parameter]['value'];
                }elseif($parameter==2){
                    $parameterCount+=Config::get('rate')['corporation']['attributes'][$parameter]['value'];
                }elseif($parameter==3){
                    $parameterCount+=Config::get('rate')['corporation']['attributes'][$parameter]['value'];
                }
                elseif($parameter==4){
                    $parameterCount+=Config::get('rate')['corporation']['attributes'][$parameter]['value'];
                }
                elseif($parameter==5){
                    $parameterCount+=Config::get('rate')['corporation']['attributes'][$parameter]['value'];
                }
            }
            $parameterAvg[$index]=$parameterCount/($key+1); //avg point foreach corporation

        }
        $finalAvg=array_sum($parameterAvg)/($index+1)/20; //final avg point foreach skill between 1-5
        $finalCorporationPoint=$finalAvg*Config::get('rate')['corporation']['weight'];

        //checking the job num (corporation count)
        $corporationCount=$corporations->count();
        $jobPoint=$corporationCount*Config::get('rate')['job']['attributes']['corporation'];
        if($jobPoint>Config::get('rate')['job']['result'][5]){ //5 star job (corporation num)
            $calculatedJobPoint=5;
        }elseif($jobPoint>Config::get('rate')['job']['result'][4] && $jobPoint<=Config::get('rate')['job']['result'][5]){
            $calculatedJobPoint=4;
        }elseif($jobPoint>Config::get('rate')['job']['result'][3] && $jobPoint<=Config::get('rate')['job']['result'][4]){
            $calculatedJobPoint=3;
        }elseif($jobPoint>Config::get('rate')['job']['result'][2] && $jobPoint<=Config::get('rate')['job']['result'][3]){
            $calculatedJobPoint=2;
        }elseif($jobPoint>=Config::get('rate')['job']['result'][1] && $jobPoint<=Config::get('rate')['job']['result'][2]){
            $calculatedJobPoint=1;
        }
        $finalJobPoint=$calculatedJobPoint*Config::get('rate')['job']['weight'];

        return[
            'finalCorporationPoint'=>$finalCorporationPoint,
            'finalJobPoint'=>$finalJobPoint
        ];
    }

    /**
     * Created By Dara on 7/12/2015
     * checking book and article
     */
    private function paper($skill){
        $count=[];
        $paperPoint=0;
        $calculatedPaperPoint=0;

        //checking for papers
        foreach($skill->papers as $key=>$paper){ //get all the books and articles for the specified skill
            $countLike=$paper->num_like;
            $countDisLike=$paper->num_dislike;
            if($paper->type==2){ //the paper is book
                $count[$key]=$countLike*Config::get('rate')['paper']['attributes']['book']['like']-($countDisLike*Config::get('paper')['attributes']['book']['dislike']);
                $count[$key]+=Config::get('rate')['paper']['attributes']['book']['book'];
            }elseif($paper->type==1){ //the paper is article
                $count[$key]=$countLike*Config::get('rate')['paper']['attributes']['article']['like']-($countDisLike*Config::get('paper')['attributes']['article']['dislike']);
                $count[$key]+=Config::get('rate')['paper']['attributes']['article']['article'];
            }
        }
        $paperPoint=array_sum($count);
        if($paperPoint>Config::get('rate')['paper']['result'][5]){ //5 star paper
            $calculatedPaperPoint=5;
        }elseif($paperPoint>Config::get('rate')['paper']['result'][4] && $paperPoint<=Config::get('rate')['paper']['result'][5]){
            $calculatedPaperPoint=4;
        }elseif($paperPoint>Config::get('rate')['paper']['result'][3] && $paperPoint<=Config::get('rate')['paper']['result'][4]){
            $calculatedPaperPoint=3;
        }elseif($paperPoint>Config::get('rate')['paper']['result'][2] && $paperPoint<=Config::get('rate')['paper']['result'][3]){
            $calculatedPaperPoint=2;
        }elseif($paperPoint>=Config::get('rate')['paper']['result'][1] && $paperPoint<=Config::get('rate')['paper']['result'][2]){
            $calculatedPaperPoint=1;
        }
        $finalPaperPoint=$calculatedPaperPoint*Config::get('rate')['paper']['weight'];
        return $finalPaperPoint;

    }

    /**
     * Created By Dara on 7/12/2015
     * history checking
     */
    private function history($skill){
        $count=[];
        $likePoint=[];
        $calculatedHistoryPoint=0;
        foreach($skill->histories as $key=>$history){ //get all the histories for the specified skill
            $countLike=$history->num_like;
            $countDisLike=$history->num_dislike;
            $likePoint[$key]=$countLike*Config::get('rate')['history']['attributes']['like']-($countDisLike*Config::get('rate')['history']['attributes']['dislike']);
            $count[$key]=Config::get('rate')['history']['attributes'][$history->penetration]['value'];
        }
        $historyPoint=array_sum($count)+array_sum($likePoint);
        if($historyPoint>Config::get('rate')['history']['result'][5]){ //5 star history
            $calculatedHistoryPoint=5;
        }elseif($historyPoint>Config::get('rate')['history']['result'][4] && $historyPoint<=Config::get('rate')['history']['result'][5]){
            $calculatedHistoryPoint=4;
        }elseif($historyPoint>Config::get('rate')['history']['result'][3] && $historyPoint<=Config::get('rate')['history']['result'][4]){
            $calculatedHistoryPoint=3;
        }elseif($historyPoint>Config::get('rate')['history']['result'][2] && $historyPoint<=Config::get('rate')['history']['result'][3]){
            $calculatedHistoryPoint=2;
        }elseif($historyPoint>=Config::get('rate')['history']['result'][1] && $historyPoint<=Config::get('rate')['history']['result'][2]){
            $calculatedHistoryPoint=1;
        }
        $finalHistoryPoint=$calculatedHistoryPoint*Config::get('rate')['history']['weight'];
        return $finalHistoryPoint;
    }

    /**
     * Created By Dara on 8/12/2015
     * checking the profile progress
     */
    private function profile($user,$profileProgressRepository){
        $calculatedProfilePoint=0;
        $profileProgress=$profileProgressRepository->calculate($user)*100; //0-100 percent
        if($profileProgress>Config::get('rate')['paper']['result'][5]){ //5 star paper
            $calculatedProfilePoint=5;
        }elseif($profileProgress>Config::get('rate')['paper']['result'][4] && $profileProgress<=Config::get('rate')['paper']['result'][5]){
            $calculatedProfilePoint=4;
        }elseif($profileProgress>Config::get('rate')['paper']['result'][3] && $profileProgress<=Config::get('rate')['paper']['result'][4]){
            $calculatedProfilePoint=3;
        }elseif($profileProgress>Config::get('rate')['paper']['result'][2] && $profileProgress<=Config::get('rate')['paper']['result'][3]){
            $calculatedProfilePoint=2;
        }elseif($profileProgress>=Config::get('rate')['paper']['result'][1] && $profileProgress<=Config::get('rate')['paper']['result'][2]){
            $calculatedProfilePoint=1;
        }
        $finalProfilePoint=$calculatedProfilePoint*Config::get('rate')['profile']['weight'];
        return $finalProfilePoint;
    }

    /**
     * created By Dara on 12/12/2015
     * check for problem answers (group)
     */
    private function answer($user){
        $answers=$user->comments()->where('commentable_type','App\Problem')->get();
        $count=[];
        $calculatedAnswerPoint=0;
        foreach($answers as $key=>$answer){
            $countLike=$answer->num_like;
            $countDisLike=$answer->num_dislike;
            $count[$key]=$countLike*Config::get('rate')['answer']['attributes']['like']-($countDisLike*Config::get('rate')['answer']['attributes']['dislike']);
            // check if the answer is true or not
            if($answer->commentable->comment_id==$answer->id){ //the answer is correct
                $count[$key]+=Config::get('rate')['answer']['attributes']['correct'];
            }else{
                $count[$key]+=Config::get('rate')['answer']['attributes']['normal'];
            }
        }
        $answerPoint=array_sum($count);
        if($answerPoint>Config::get('rate')['answer']['result'][5]){ //5 star paper
            $calculatedAnswerPoint=5;
        }elseif($answerPoint>Config::get('rate')['answer']['result'][4] && $answerPoint<=Config::get('rate')['answer']['result'][5]){
            $calculatedAnswerPoint=4;
        }elseif($answerPoint>Config::get('rate')['answer']['result'][3] && $answerPoint<=Config::get('rate')['answer']['result'][4]){
            $calculatedAnswerPoint=3;
        }elseif($answerPoint>Config::get('rate')['answer']['result'][2] && $answerPoint<=Config::get('rate')['answer']['result'][3]){
            $calculatedAnswerPoint=2;
        }elseif($answerPoint>=Config::get('rate')['answer']['result'][1] && $answerPoint<=Config::get('rate')['answer']['result'][2]){
            $calculatedAnswerPoint=1;
        }
        $finalAnswerPoint=$calculatedAnswerPoint*Config::get('rate')['answer']['weight'];
        return $finalAnswerPoint;
    }

    /**
     * Created By Dara on 12/12/2015
     * checking for profile visitors foreach user
     */
    private function profileVisit($user){
        $calculatedVisitPoint=0;
        $profileVisits=$user->profileVisits($user)->lastMonth()->count();
        $profileVisitPoint=$profileVisits;
        if($profileVisitPoint>Config::get('rate')['profileVisit']['result'][5]){ //5 star paper
            $calculatedVisitPoint=5;
        }elseif($profileVisitPoint>Config::get('rate')['profileVisit']['result'][4] && $profileVisitPoint<=Config::get('rate')['profileVisit']['result'][5]){
            $calculatedVisitPoint=4;
        }elseif($profileVisitPoint>Config::get('rate')['profileVisit']['result'][3] && $profileVisitPoint<=Config::get('rate')['profileVisit']['result'][4]){
            $calculatedVisitPoint=3;
        }elseif($profileVisitPoint>Config::get('rate')['profileVisit']['result'][2] && $profileVisitPoint<=Config::get('rate')['profileVisit']['result'][3]){
            $calculatedVisitPoint=2;
        }elseif($profileVisitPoint>=Config::get('rate')['profileVisit']['result'][1] && $profileVisitPoint<=Config::get('rate')['profileVisit']['result'][2]){
            $calculatedVisitPoint=1;
        }
        $finalVisitPoint=$calculatedVisitPoint*Config::get('rate')['profileVisit']['weight'];
        return $finalVisitPoint;
    }

    private function share($user){
        $count=[];
        $calculatedSharePoint=0;
        $shares=$user->shares()->get();
        foreach($shares as $key=>$share){
            $count[$key]=Config::get('rate')['share']['attributes']['share'];
            $count[$key]+=($share->num_visit)*(Config::get('rate')['share']['attributes']['visit']);
        }
        $sharePoint=array_sum($count);
        if($sharePoint>Config::get('rate')['share']['result'][5]){ //5 star paper
            $calculatedSharePoint=5;
        }elseif($sharePoint>Config::get('rate')['share']['result'][4] && $sharePoint<=Config::get('rate')['share']['result'][5]){
            $calculatedSharePoint=4;
        }elseif($sharePoint>Config::get('rate')['share']['result'][3] && $sharePoint<=Config::get('rate')['share']['result'][4]){
            $calculatedSharePoint=3;
        }elseif($sharePoint>Config::get('rate')['share']['result'][2] && $sharePoint<=Config::get('rate')['share']['result'][3]){
            $calculatedSharePoint=2;
        }elseif($sharePoint>=Config::get('rate')['share']['result'][1] && $sharePoint<=Config::get('rate')['share']['result'][2]){
            $calculatedSharePoint=1;
        }
        $finalSharePoint=$calculatedSharePoint*Config::get('rate')['share']['weight'];
        return $finalSharePoint;
    }
}
