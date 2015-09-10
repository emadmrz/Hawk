<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Info extends Model
{
    protected $table = 'infos';
    protected $fillable = ['user_id', 'phone1', 'phone2', 'cell_phone', 'fax', 'address'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getHumanUpdatedAtAttribute()
    {
        return jDate::forge($this->attributes['updated_at'])->ago();
}

}
