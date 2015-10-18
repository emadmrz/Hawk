<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable=['user_id', 'skill_id', 'description', 'city_id'];
    protected $appends = ['city_name', 'province_name'];

    public function city(){
        return $this->belongsTo('App\Province');
    }

    public function getCityNameAttribute(){
        return Province::find($this->attributes['city_id'])->name;
    }

    public function getProvinceNameAttribute(){
        return Province::find($this->attributes['city_id'])->getRoot()->name;
    }



}
