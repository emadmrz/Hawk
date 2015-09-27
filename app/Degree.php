<?php

namespace App;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use LikeRepository;

    protected $table = 'degrees';
    protected $fillable = ['skill_id', 'title', 'creator', 'get_date', 'expiration_date', 'description', 'num_like', 'num_dislike'];

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

}
