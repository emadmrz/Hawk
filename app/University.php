<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{

    protected $fillable = ['name', 'logo'];

    public function educations(){
        $this->belongsToMany('App\Education')->withTimestamps();
    }
}
