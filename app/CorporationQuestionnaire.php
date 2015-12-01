<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CorporationQuestionnaire extends Model
{
    protected $table='corporation_questionnaire';

    protected $fillable=['content'];
}
