<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biography extends Model
{
    protected $table = 'biographies';
    protected $fillable = ['user_id', 'text'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get all of the attachment's files.
     */
    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }
}
