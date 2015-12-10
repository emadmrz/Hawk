<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 10/12/2015
 * Time: 07:05 PM
 */

namespace App\Repositories;


class HistoryRepository
{
    public function penetration_name(){
        return  [
            1 => 'همیشه',
            2 => 'بیشتر اوقات',
            3 => 'برخی اوقات',
            4 => 'به ندرت'
        ];
    }
}