<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['user_id', 'title', 'logo', 'phone', 'address', 'num_visit', 'num_buy', 'rate', 'description', 'status', 'about_us', 'contact_us', 'theme'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->morphOne('App\Payment', 'itemable');
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format("Y/m/d H:i:s");
    }

    public function advantages(){
        return $this->belongsToMany('App\Advantage')->withTimestamps();
    }

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function files()
    {
        return $this->morphMany('App\File', 'imageable');
    }

    public function commercials(){
        return $this->hasMany('App\Commercial');
    }

    public function visit(){
        $this->increment('num_visit');
    }

}
