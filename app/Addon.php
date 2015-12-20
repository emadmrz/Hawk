<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $table = 'addons';
    protected $fillable = ['name', 'num_comment', 'num_visit', 'num_buy'];

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function visit(){
        $this->increment('num_visit');
    }

    public function buy(){
        $this->increment('num_buy');
    }

    public function scopeStorage($query){
        $query->where('name', 'storage');
    }

    public function scopeShop($query){
        $query->where('name', 'shop');
    }

    public function scopePoll($query){
        $query->where('name', 'poll');
    }

    public function scopeQuestionnaire($query){
        $query->where('name', 'questionnaire');
    }

    public function scopeAdvertise($query){
        $query->where('name', 'advertise');
    }

    public function scopeOffer($query){
        $query->where('name','offer');
    }

    public function scopeRelater($query){
        $query->where('name','relater');
    }

    public function scopeProfit($query){
        $query->where('name','profit');
    }

    public function scopeShowcase($query){
        $query->where('name','showcase');
    }

}
