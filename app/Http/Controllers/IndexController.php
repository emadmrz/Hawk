<?php

namespace App\Http\Controllers;

use App\Advertise;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index(){
        $advertises = Advertise::where('expired_at', '>', Carbon::now())->groupBy('user_id')->get();
//        $fruits = array('apple' => '100', 'orange' => '50', 'pear' => '10');

        $newFruits = [];
        foreach ($advertises as $key=>$value)
        {
            if($value->type == 1){
                $multi = 24;
            }elseif($value->type == 2){
                $multi = 12;
            }elseif($value->type == 3){
                $multi = 6;
            }
            $newFruits = array_merge($newFruits, array_fill(0, $multi, $value->user_id));
        }
        $results=[];
        while(count($results) != count($advertises)){
            $random_value = $newFruits[array_rand($newFruits)];
            if(!in_array($random_value, $results)){
                $results[] = $random_value;
            }
        }
//        dd($results);
        $output = [];
        foreach($results as $result){
            $output[] = $advertises->where('user_id', $result)->first();
        }
//        dd($output);
        return view('index.index',compact('output'));
    }
}
