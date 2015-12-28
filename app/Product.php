<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;

    protected $table = 'products';
    protected $fillable = ['user_id', 'skill_id', 'shop_id', 'category_id', 'name', 'price', 'discount', 'guarantee', 'warranty', 'description', 'status', 'available', 'num_visit', 'num_comment', 'num_buy','active'];

    protected $searchable = [
        'columns' => [
            'name' => 20,
            'description' => 5,
        ]
    ];

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function skill(){
        return $this->belongsTo('App\Skill');
    }

    public function shop(){
        return $this->belongsTo('App\Shop');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function getTagsListAttribute(){
        return $this->tags->lists('id')->toArray();
    }

    public function attributes(){
        return $this->hasMany('App\Attribute');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function visit(){
        $this->increment('num_visit');
    }
}
