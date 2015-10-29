<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    protected $fillable = ['user_id', 'title', 'description', 'requirements', 'sub_category_id', 'my_rate', 'status'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function getTagsListAttribute(){
        return $this->tags->lists('id')->toArray();
    }

    public function getCategoryIdAttribute(){
        return Category::find($this->attributes['sub_category_id'])->getRoot()->id;
    }

    public function experiences(){
        return $this->hasMany('App\Experience');
    }

    public function degrees(){
        return $this->hasMany('App\Degree');
    }

    public function honors(){
        return $this->hasMany('App\Honor');
    }

    public function histories(){
        return $this->hasMany('App\History');
    }

    public function schedules(){
        return $this->hasMany('App\Schedule');
    }

    public function papers(){
        return $this->hasMany('App\Paper');
    }

    public function amounts(){
        return $this->hasMany('App\Amount');
    }

    public function areas(){
        return $this->hasMany('App\Area');
    }

    public function galleries(){
        return $this->hasMany('App\Gallery');
    }

    public function recommendations(){
        return $this->hasMany('App\Recommendation');
    }

    public function endorses(){
        return $this->hasMany('App\Endorse');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
}
