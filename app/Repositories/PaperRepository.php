<?php
/**
 * Created by PhpStorm.
 * User: emad
 * Date: 21/09/2015
 * Time: 04:33 PM
 */

namespace App\Repositories;


class PaperRepository {

    public function type_name(){
        return [
            1 => 'مقاله',
            2 => 'کتاب',
        ];
    }

}