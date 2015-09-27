<?php

namespace App;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use LikeRepository;

    protected $table = 'galleries';
    protected $fillable = ['skill_id', 'title', 'num_like', 'num_dislike'];

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }
}
