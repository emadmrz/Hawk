<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class CorporationAnswer extends Model
{
    protected $table='corporation_answer';

    protected $fillable=['corporation_id','question_id','answer'];

    public function corporation(){
        return $this->belongsTo('App\Corporation');
    }

    public function question(){
        return $this->belongsTo('App\CorporationQuestionnaire','question_id','id');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }
}
