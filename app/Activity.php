<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\jDate;

class Activity extends Model
{
    protected $table= 'activities';
    protected $fillable = ['user_id', 'online', 'status'];
    protected $appends = ['activity_status', 'shamsi_human_updated_at'];

    public function getActivityStatusAttribute(){
        if($this->attributes['status'] == 0){
            return 0;
        }elseif($this->attributes['status'] == 1){
            if($this->attributes['online'] == 1){
                return 1;
            }elseif($this->attributes['online'] == 0){
                return 0;
            }
        }
    }

    public function getShamsiHumanUpdatedAtAttribute(){
        return jDate::forge($this->attributes['updated_at'])->ago();
    }
}
