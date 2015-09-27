<?php

namespace App;

use App\Repositories\ScheduleRepository;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = ['skill_id','week_day','start_time','end_time','title'];
    protected $appends = ['day_name'];

    public function getScheduleTableAttribute(){
        $start_time = explode(':', $this->attributes['start_time']);
        $end_time = explode(':', $this->attributes['end_time']);
        $diff = (($end_time[0]*60+$end_time[1])-($start_time[0]*60+$start_time[1]))/60;
        $width = ($diff*100)/24;
        $margin = ((($start_time[0]*60+$start_time[1])/60)*100)/24;
        return ['width'=>$width, 'margin'=>$margin];
    }

    public function getDayNameAttribute(){
        $scheduleRepository = new ScheduleRepository();
        $week_days = $scheduleRepository->week_days();
        return $week_days[$this->attributes['week_day']];
    }
}
