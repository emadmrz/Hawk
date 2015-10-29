<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advantage extends Model
{
    protected $table = 'advantages';
    protected $fillable = ['title', 'logo', 'description', 'status'];

    public function shop(){
        return $this->belongsToMany('App\Shop')->withTimestamps();
    }
}
