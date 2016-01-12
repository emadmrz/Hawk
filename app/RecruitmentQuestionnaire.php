<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecruitmentQuestionnaire extends Model
{
    protected $table='recruitment_questionnaire';

    protected $fillable=['content','user_id'];

    public function recruitments(){
        return $this->belongsToMany('App\Recruitment','question_recruitment','question_id','recruitment_id');
    }
}
