<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $tabel = 'posts';
    protected $fillable = ['user_id', 'content', 'location', 'image', 'num_like', 'num_comment'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('%A %d %B %Y ');
    }
}
