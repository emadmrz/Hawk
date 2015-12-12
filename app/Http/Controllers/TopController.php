<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function index(Request $request){
        //get all the first-level categories
        $firstCategories=Category::where('parent_id',null)->get();
        $results=[];
        $limit=5;
        foreach($firstCategories as $key=>$firstCategory){
            $q="SELECT users.*";
            $q=$q." From `users` LEFT JOIN `skills` ON `users`.`id`=`skills`.`user_id`";
            $q=$q." LEFT JOIN `categories` ON `categories`.`id`=`skills`.`sub_category_id`";
            $secondCategories=$firstCategory->children()->lists('id')->toArray();
            $c=implode(',',$secondCategories);
            $q=$q." WHERE `categories`.`id` IN (".$c.")";
            if($request->has('show') && $request->input('show')==$firstCategory->id){
                $limit=20;
            }
            $q=$q." GROUP BY `users`.`id` ORDER BY `skills`.`rate` DESC LIMIT $limit";
            $m=DB::select($q);
            $results[$firstCategory->id]=$m;
        }

        dd($results);

    }
}
