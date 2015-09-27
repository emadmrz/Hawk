<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name', 'parent_id'];

    public function skills(){
        return $this->belongsToMany('App\Skill');
    }
}
