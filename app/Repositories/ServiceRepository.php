<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 11/10/2015
 * Time: 05:31 PM
 */

namespace App\Repositories;


class ServiceRepository {

    public function all(){
        return [
            1 => 'پارگینگ',
            2 => 'اینترنت',
            3 => 'رزرو اینترنتی',
            4 => 'وب سایت	',
            5 => 'کارت خوان',
            6 => 'دسترسی به حمل و نقل عمومی',
            7 => 'نوبت دهی تلفنی',
            8 => 'مشاوره تخصصی',
            9 => 'خدمت در محل',
            10 => 'فضای مناسب',
            11 => 'بوفه',
            12 => 'پذیرایی رایگان',
            0 => 'سایر',
        ];
    }
}