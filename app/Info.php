<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Info extends Model
{
    protected $table = 'infos';
    protected $fillable = ['user_id', 'phone1', 'phone2', 'cell_phone', 'fax', 'address', 'city_id', 'province_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getHumanUpdatedAtAttribute()
    {
        return jDate::forge($this->attributes['updated_at'])->ago();
    }

    public function city(){
        return $this->belongsTo('App\Province');
    }

    public function province(){
        return $this->belongsTo('App\Province');
    }

    public function getCityAttribute(){
        if(!is_null($this->attributes['city_id'])){
            $city = $this->city()->find($this->attributes['city_id']);
            return $city['name'];
        }else{
            return '';
        }

    }

    public function getProvinceAttribute(){
        if(!is_null($this->attributes['province_id'])){
            $province = $this->province()->find($this->attributes['province_id']);
            return  $province['name'];
        }else{
            return '';
        }

    }

}
