<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 11/09/2015
 * Time: 07:54 PM
 */

namespace App\Repositories;


class EducationRepository {

    public function statuses(){
        return  [
            0 => 'در حال تحصیل',
            1 => 'فارغ التحصیل'
        ];
    }

    public function degrees(){
        return [
            1 => 'کارشناسی' ,
            2 => 'کارشناسی ارشد' ,
            3 => 'دکتری'
        ];
    }



}