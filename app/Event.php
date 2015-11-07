<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDateTime;
use Morilog\Jalali\jDate;

class Event extends Model
{
    protected $table='events';

    protected $fillable=['from_time','to_time','name'];

    public function setFromTimeAttribute($date){
        $jalali = explode('/', $date);
        $this->attributes['from_time'] = implode('-', jDateTime::toGregorian($jalali[0], $jalali[1], $jalali[2]));
    }

    public function setToTimeAttribute($date){
        $jalali = explode('/', $date);
        $this->attributes['to_time'] = implode('-', jDateTime::toGregorian($jalali[0], $jalali[1], $jalali[2]));
    }

    public function getShamsiFromTimeAttribute(){
        return jDate::forge($this->attributes['from_time'])->format('Y/m/d');
    }

    public function getShamsiToTimeAttribute(){
        return jDate::forge($this->attributes['to_time'])->format('Y/m/d');
    }
}
