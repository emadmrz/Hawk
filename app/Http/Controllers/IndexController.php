<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $fruits = array('apple' => '100', 'orange' => '50', 'pear' => '10');

        $newFruits = array();
        foreach ($fruits as $fruit=>$value)
        {
            $newFruits = array_merge($newFruits, array_fill(0, $value, $fruit));
        }
        $result=[];
        while(count($result) != 3){
            $random_value = $newFruits[array_rand($newFruits)];
            if(!in_array($random_value, $result)){
                $result[] = $random_value;
            }
        }
        dd($result);
    }
}
