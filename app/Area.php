<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable=['user_id', 'skill_id', 'description', 'city_id'];

    public function city(){
        return $this->belongsTo('App\Province');
    }
}
