<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tick extends Model
{
    protected $table = 'ticks';
    protected $fillable = ['user_id', 'questionnaire_id', 'question_id', 'option_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function questionnaire(){
        return $this->belongsTo('App\Questionnaire');
    }

    public function question(){
        return $this->belongsTo('App\Question');
    }

    public function option(){
        return $this->belongsTo('App\Option');
    }
}
