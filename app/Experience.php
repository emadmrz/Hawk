<?php

namespace App;

use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use LikeRepository;

    protected $table = 'experiences';
    protected $fillable = ['skill_id', 'title', 'description', 'num_like', 'num_dislike'];
    protected $appends = ['file_type'];

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

    public function getFileTypeAttribute(){
        return $this->files()->first()->extension;
    }

}
