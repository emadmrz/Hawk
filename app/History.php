<?php

namespace App;

use App\Repositories\HistoryRepository;
use App\Repositories\LikeRepository;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use LikeRepository;
    protected $table = 'histories';
    protected $fillable = ['skill_id', 'title', 'phone', 'email', 'address', 'description', 'start_year', 'end_year', 'num_like', 'num_dislike', 'penetration'];
    protected $appends = ['penetration_name'];

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'likeable');
    }

    public function getPenetrationNameAttribute(){
        $historyRepositories = new HistoryRepository();
        $values = $historyRepositories->penetration_name();
        return $values[$this->attributes['penetration']];
    }
}
