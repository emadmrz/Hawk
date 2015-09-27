<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';
    protected $fillable=['user_id', 'visitable_id', 'visitable_type'];

    public function visitable()
    {
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
