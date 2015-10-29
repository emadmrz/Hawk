<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commercial extends Model
{
    protected $table = 'commercials';
    protected $fillable = ['shop_id', 'title', 'url'];

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    public function file()
    {
        return $this->morphOne('App\File', 'imageable');
    }
}
