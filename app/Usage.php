<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $table = 'usages';
    protected $fillable = ['user_id', 'capacity', 'usage'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function add($volume){
        $this->increment('usage', $volume);
    }

    public function freeup($volume){
        $this->increment('capacity', $volume);
    }

    public function freeDown($volume){
        $this->decrement('capacity',$volume);
    }
}
