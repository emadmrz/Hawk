<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    protected $table = 'streams';
    protected $fillable = ['user_id', 'edge_rank', 'contentable_id', 'contentable_type', 'parentable_id', 'parentable_type', 'is_see'];

    public function contentable()
    {
        return $this->morphTo('contentable');
    }

    public function parentable()
    {
        return $this->morphTo('parentable');
    }

    public function scopeUnseen($query)
    {
        return $query->where('is_see', 0);
    }
    public function scopeNotifier($query){
        $acceptable = ['App\Post', 'App\Article', 'App\Endorse','App\Recommendation', 'App\Comment','App\Problem','App\Corporation','App\Showcase'];
        return $query->whereIn('contentable_type', $acceptable);
    }
}
