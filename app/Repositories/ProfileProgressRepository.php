<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 25/09/2015
 * Time: 07:55 AM
 */

namespace App\Repositories;


class ProfileProgressRepository {

    private $progress =0;
    private $userTotalWeight = [0.5, 0.5, 0.5, 0.5, 0.25, 0.2, 2, 2.5, 1, 5, 7, 5, 5, 0.5, 0.4, 0.3, 0.5, 0.4, 0.8, 0.6, 0.6, 0.9, 1.1, 0.8, 0.6, 0.3, 0.7, 1.5, 0.3, 0.25, 0.2, 0.2, 0.25, 0.44, 0.36, 0.36, 0.5, 0.62, 0.5, 0.42, 0.3, 0.4, 0.9, 3, 4, 5];
    private $legalTotalWeight = [1, 0.7, 0.5, 0.25, 0.25, 1, 1.5, 1, 5, 7, 5, 5, 0.6, 0.5, 0.4, 0.5, 1.2, 1, 0.8, 1.5, 1, 1, 1.5, 3, 4, 5];

    public function calculate($user){

        //dd(array_sum($this->userTotalWeight));
        //dd(array_sum($this->legalTotalWeight));
        $role = $user->roles->first();

        if($role->slug == 'user'){
            $this->info($user);
            $this->education($user);
            $this->skill($user);
            $total = array_sum($this->userTotalWeight);
        }

        if($role->slug == 'legal'){
            $this->legal($user);
            $this->legalSkill($user);
            $this->location($user);
            $total = array_sum($this->legalTotalWeight);
        }


        $this->biography($user);
        $this->avatar($user);
        $this->description($user);
        $this->articles($user);
        $this->posts($user);
        $this->recommendations($user);

        return ($this->progress)/$total;
    }

    private function info($user){
        $total_value = [];
        $info = $user->info;

        if(!empty($user->first_name))
            $total_value[]=1*0.5;
        if(!empty($user->last_name))
            $total_value[]=1*0.5;
        if(!empty($info->phone1))
            $total_value[]=1*0.5;
        if(!empty($info->cell_phone))
            $total_value[]=1*0.5;
        if(!empty($info->fax))
            $total_value[]=1*0.25;
        if(!empty($user->email))
            $total_value[]=1*0.2;
        if(!empty($info->province_id))
            $total_value[]=1*2.5;
        if(!empty($info->city_id))
            $total_value[]=1*2;
        if(!empty($info->address) and strlen($info->address) > 10 )
            $total_value[]=1*1;

        $this->progress += array_sum($total_value);
    }

    private function legal($user){
        $total_value = [];
        $info = $user->info;

        if(!empty($user->company))
            $total_value[]=1*1;
        if(!empty($info->phone1))
            $total_value[]=1*0.7;
        if(!empty($info->phone2))
            $total_value[]=1*0.3;
        if(!empty($info->cell_phone))
            $total_value[]=1*0.5;
        if(!empty($info->fax))
            $total_value[]=1*0.25;
        if(!empty($user->email))
            $total_value[]=1*0.25;
        if(!empty($info->province_id))
            $total_value[]=1*1.5;
        if(!empty($info->city_id))
            $total_value[]=1*1;
        if(!empty($info->address) and strlen($info->address) > 10 )
            $total_value[]=1*1;

        $this->progress += array_sum($total_value);
    }

    private function education($user){
        $total_value = [];
        $educations = $user->educations;
        if(count($educations)){
            $education = $educations->first()->toArray();
            $education = array_except($education, 'status');
            if(array_search('',array_flatten($education)) and array_search(' ',array_flatten($education)) ){
                $total_value[]=0.5*5;
            }else{
                $total_value[]= 1*5;
            }
            $this->progress += array_sum($total_value);
        }
    }

    private function biography($user){
        $total_value = [];
        $biography = $user->biography;
        $count = strlen($biography->text);
        $attachment = count($biography->attachments);
        if($count >= 150 and $count < 300)
            $total_value[]=0.25*7;
        elseif($count >= 300 and $count < 500)
            $total_value[]=0.5*7;
        elseif($count >= 500 )
            $total_value[]=1*7;

        if($attachment == 1)
            $total_value[]=0.2*7;
        elseif($attachment == 1)
            $total_value[]=0.3*7;
        elseif($attachment > 2)
            $total_value[]=0.35*7;

        $this->progress += array_sum($total_value);
    }

    private function avatar($user){
        $total_value = [];
        if(!is_null($user->image)){
            $total_value[]=1*5;
        }

        $this->progress += array_sum($total_value);
    }

    private function description($user){
        $total_value = [];
        if(!empty($user->description)){
            $total_value[]=1*5;
        }

        $this->progress += array_sum($total_value);
    }

    private function skill($user){
        $total_value = [];
        $skills = $user->skills;

        if(count($skills) > 0 ){
            $skill = $skills->first();

            if($skill->sub_category_id){
                $total_value[] = 1*0.5;
                $total_value[] = 1*0.4;
            }
            $num_tags = count($skill->tags);
            if($num_tags == 1){
                $total_value[] = 0.25*0.5;
            }elseif($num_tags == 2){
                $total_value[] = 0.5*0.5;
            }elseif($num_tags > 2){
                $total_value[] = 1*0.5;
            }

            if($skill->my_rate){
                $total_value[] = 1*0.4;
            }

            $descriptionLen = strlen($skill->description);
            if($descriptionLen >= 50 and $descriptionLen < 150){
                $total_value[] = 0.5*0.8;
            }elseif($descriptionLen >= 150){
                $total_value[] = 1*0.8;
            }

            if(count($skill->schedules)> 0 and $skill->status==1){
                $total_value[] = 1*0.6;
            }

            if(count($skill->areas)> 0 and $skill->status==1){
                $total_value[] = 1*0.6;
            }

            $experience_num = count($skill->experiences);
            if($experience_num == 1){
                $total_value[] = 0.25*0.9;
            }elseif($experience_num == 2){
                $total_value[] = 0.5*0.9;
            }elseif($experience_num > 2){
                $total_value[] = 1*0.9;
            }

            if(count($skill->degrees) > 0){
                $total_value[] = 1*1.1;
            }

            $papers_num = count($skill->papers);
            if($papers_num == 1 ){
                $total_value[] = 0.25*0.6;
            }elseif($papers_num >= 2 and $papers_num < 5){
                $total_value[] = 0.5*0.6;
            }elseif($papers_num >= 5){
                $total_value[] = 1*0.6;
            }

            if(strlen($skill->requirements) > 0){
                $total_value[] = 1*0.3;
            }

            if(count($skill->honors) > 0){
                $total_value[] = 1*0.7;
            }

            if(count($skill->amounts)> 0 and $skill->status==1){
                $total_value[] = 1*1.5;
            }


        }

        if(count($skills) > 1){
            $skill = $skills->get(1);
            if($skill->sub_category_id){
                $total_value[] = 1*0.3;
                $total_value[] = 1*0.25;
            }
            $num_tags = count($skill->tags);
            if($num_tags == 1){
                $total_value[] = 0.25*0.2;
            }elseif($num_tags == 2){
                $total_value[] = 0.5*0.2;
            }elseif($num_tags > 2){
                $total_value[] = 1*0.2;
            }

            if($skill->my_rate){
                $total_value[] = 1*0.25;
            }

            $descriptionLen = strlen($skill->description);
            if($descriptionLen >= 50 and $descriptionLen < 150){
                $total_value[] = 0.5*0.44;
            }elseif($descriptionLen >= 150){
                $total_value[] = 1*0.44;
            }

            if(count($skill->schedules)> 0 and $skill->status==1){
                $total_value[] = 1*0.36;
            }

            if(count($skill->areas)> 0 and $skill->status==1){
                $total_value[] = 1*0.36;
            }

            $experience_num = count($skill->experiences);
            if($experience_num == 1){
                $total_value[] = 0.25*0.5;
            }elseif($experience_num == 2){
                $total_value[] = 0.5*0.5;
            }elseif($experience_num > 2){
                $total_value[] = 1*0.5;
            }

            if(count($skill->degrees) > 0){
                $total_value[] = 1*0.62;
            }

            $papers_num = count($skill->papers);
            if($papers_num == 1 ){
                $total_value[] = 0.25*0.42;
            }elseif($papers_num >= 2 and $papers_num < 5){
                $total_value[] = 0.5*0.42;
            }elseif($papers_num >= 5){
                $total_value[] = 1*0.42;
            }

            if(strlen($skill->requirements) > 0){
                $total_value[] = 1*0.3;
            }

            if(count($skill->honors) > 0){
                $total_value[] = 1*0.4;
            }

            if(count($skill->amounts)> 0 and $skill->status==1){
                $total_value[] = 1*0.9;
            }
        }

        $this->progress += array_sum($total_value);

    }

    private function legalSkill($user){
        $total_value = [];
        $skills = $user->skills;
        if(count($skills) > 0 ){
            $skill = $skills->first();
            if($skill->sub_category_id){
                $total_value[] = 1*0.6;
                $total_value[] = 1*0.5;
            }
            $num_tags = count($skill->tags);
            if($num_tags == 1){
                $total_value[] = 0.25*0.5;
            }elseif($num_tags == 2){
                $total_value[] = 0.5*0.5;
            }elseif($num_tags > 2){
                $total_value[] = 1*0.5;
            }

            $num_gallery = count($skill->galleries);
            if($num_gallery >= 1 and $num_gallery < 3){
                $total_value[] = 0.25*1;
            }elseif($num_gallery >= 3 and $num_gallery < 5){
                $total_value[] = 0.5*1;
            }elseif($num_gallery >= 5){
                $total_value[] = 1*1;
            }

            $descriptionLen = strlen($skill->description);
            if($descriptionLen >= 50 and $descriptionLen < 150){
                $total_value[] = 0.5*1.2;
            }elseif($descriptionLen >= 150){
                $total_value[] = 1*1.2;
            }

            if(count($skill->schedules)> 0 and $skill->status==1){
                $total_value[] = 1*1;
            }

//            if(count($skill->areas)> 0 and $skill->status==1){
//                $total_value[] = 1*0.6;
//            }


            if(count($skill->degrees) > 0){
                $total_value[] = 1*1.5;
            }


            if(strlen($skill->requirements) > 0){
                $total_value[] = 1*0.8;
            }

            if(count($skill->honors) > 0){
                $total_value[] = 1*1;
            }

            if(count($skill->amounts)> 0 and $skill->status==1){
                $total_value[] = 1*1.5;
            }

        }
        $this->progress += array_sum($total_value);
    }

    private function location($user){
        $total_value = [];
        $location = $user->location;
        if(!empty($location->lat) and !empty($location->lng)){
            $total_value [] = 1*5;
            $this->progress += array_sum($total_value);
        }
    }

    public function articles($user){
        $total_value = [];
        $articles = $user->articles;
        if(count($articles) == 1){
            $total_value [] = 0.2*4;
        }elseif(count($articles) == 2){
            $total_value [] = 0.5*4;
        }elseif(count($articles) == 3){
            $total_value [] = 1*4;
        }elseif(count($articles) > 3){
            $total_value [] = 1*6;
        }
        $this->progress += array_sum($total_value);
    }

    public function posts($user){
        $total_value = [];
        $posts = $user->posts;
        if(count($posts) == 1){
            $total_value [] = 0.2*3;
        }elseif(count($posts) == 2){
            $total_value [] = 0.5*3;
        }elseif(count($posts) == 3){
            $total_value [] = 1*3;
        }elseif(count($posts) > 3){
            $total_value [] = 1*5;
        }
        $this->progress += array_sum($total_value);
    }

    public function recommendations($user){
        $total_value = [];
        $recommendations = $user->recommendations;
        if(count($recommendations) == 1){
            $total_value [] = 0.25*0.5;
        }elseif(count($recommendations) == 2){
            $total_value [] = 0.5*0.5;
        }elseif(count($recommendations) == 3){
            $total_value [] = 1*0.5;
        }
        $this->progress += array_sum($total_value);
    }


}