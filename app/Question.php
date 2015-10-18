<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = ['questionnaire_id', 'title'];

    public function questionnaire(){
        return $this->belongsTo('App\Questionnaire');
    }

    public function options(){
        return $this->hasMany('App\Option');
    }
}
