<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = ['skill_id', 'title', 'phone', 'email', 'address', 'description', 'start_year', 'end_year', 'num_like', 'num_dislike'];

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }
}
