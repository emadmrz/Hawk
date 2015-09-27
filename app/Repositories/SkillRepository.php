<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 16/09/2015
 * Time: 09:32 PM
 */

namespace App\Repositories;


class SkillRepository {

    public function my_rate(){
        $rates = [
            1 => 'کاملاً حرفه ایی',
            2 => 'قابل قبول',
            3 => 'تازه کار',
        ];
        return $rates;
    }

    public function statuses(){
        $statues = [
            0 => 'غیرقابل ارائه',
            1 => 'قابل ارائه',
        ];
        return $statues ;
    }

}