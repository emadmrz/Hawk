<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 21/09/2015
 * Time: 06:42 PM
 */

namespace App\Repositories;


class AmountRepository {

    public function units(){
        return[
            1 => 'ریال',
            2 => 'دلار',
            3 => 'یورو',
        ];
    }

    public function per_units(){
        return [
            1 => 'عدد',
            2 => 'متر',
            3 => 'متر مکعب',
            4 => 'برگ',
            5 => 'جلد',
            6 => 'جین',
        ];
    }

    public function type(){
        return [
            0 => 'مجانی',
            1 => 'مقطوع',
            2 => 'توافقی',

        ];
    }

}