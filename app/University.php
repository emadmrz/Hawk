<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $tabel = 'universities';
    protected $fillable = ['name', 'logo'];

    public function educations(){
        return $this->belongsToMany('App\Education')->withTimestamps();
    }
}
