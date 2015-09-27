<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 20/09/2015
 * Time: 06:09 PM
 */

namespace App\Repositories;


use Carbon\Carbon;

class ScheduleRepository {

    public function week_days(){
        return [
            1 => 'شنبه',
            2 => 'یکشنبه',
            3 => 'دوشنبه',
            4 => 'سه شنبه',
            5 => 'چهارشنبه',
            6 => 'پنج شنبه',
            7 => 'جمعه'
        ];
    }

}