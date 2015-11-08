<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Credit extends Model
{
    protected $table='credits';

    protected $fillable=['user_id','amount','description'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getOperationAttribute(){
        if($this->attributes['amount']>0){
            return 'واریز';
        }elseif($this->attributes['amount']<0){
            return 'برداشت';
        }
    }

    public function getShamsiCreatedAtAttribute(){
        return jDate::forge($this->attributes['created_at'])->format('Y/m/d');
    }

}
