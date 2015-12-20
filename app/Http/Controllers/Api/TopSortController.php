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

            $result[1]=new \stdClass();
            $result[1]->id=2;
            $result[1]->name='پر بازدید ترین ها';

            $result[2]=new \stdClass();
            $result[2]->id=3;
            $result[2]->name='پر مشتری ترین ها';

            $result[3]=new \stdClass();
            $result[3]->id=4;
            $result[3]->name='جدید ترین ها';

            $result[4]=new \stdClass();
            $result[4]->id=5;
            $result[4]->name='پیشنهاد ویژه';
        }elseif($request->input('type_id')==2){ //product selected
            $result[0]=new \stdClass();
            $result[0]->id=6;
            $result[0]->name='محبوب ترین ها';

            $result[1]=new \stdClass();
            $result[1]->id=7;
            $result[1]->name='پر فروش ترین ها';

            $result[2]=new \stdClass();
            $result[2]->id=8;
            $result[2]->name='پر بازدید ترین ها';

            $result[3]=new \stdClass();
            $result[3]->id=9;
            $result[3]->name='جدید ترین ها';

        }
        return $result;
    }
}
