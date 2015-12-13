<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TopSortController extends Controller
{
    public function sort(Request $request){
        $result=[];
        if($request->input('type_id')==1){ //user selected
            $result[0]=new \stdClass();
            $result[0]->id=1;
            $result[0]->name='پر ستاره ترین ها';
        }elseif($request->input('type_id')==2){ //product selected
            $result[0]=new \stdClass();
            $result[0]->id=2;
            $result[0]->name='محبوب ترین ها';

            $result[1]=new \stdClass();
            $result[1]->id=3;
            $result[1]->name='پر فروش ترین ها';

            $result[2]=new \stdClass();
            $result[2]->id=4;
            $result[2]->name='پر بازدید ترین ها';

        }
        return $result;
    }
}
