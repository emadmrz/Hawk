<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecruitmentAnswer extends Model
{
    protected $table='recruitment_answer';

    protected $fillable=['recruitment_id','question_id','user_id','content'];

    public function question(){
        return $this->belongsTo('App\RecruitmentQuestionnaire');
    }
}
