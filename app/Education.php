<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = ['user_id', 'university_id', 'degree', 'field', 'entrance_year', 'graduate_year', 'status'];

    public function university(){
        $this->hasOne('App\University');
    }
}
