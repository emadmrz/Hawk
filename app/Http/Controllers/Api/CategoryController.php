<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function sub(Request $request){
        /**
         * changed By Dara on 16/11/2015
         * if the category_id ==0 then dont search for its subCategory
         */
        $sub_category=[];
        $sub_category[0]=new \stdClass();
        $sub_category[0]->name='انتخاب کنید';
        $sub_category[0]->id=0;
        $all_sub_categories=Category::findOrFail($request->input('category_id'))->getDescendants();
        foreach($all_sub_categories as $category){
            $sub_category[]=$category;
        }

        return $sub_category;
    }

    public function tags(Request $request){
        return Tag::where('parent_id', $request->input('sub_category_id'))->get();
    }
}
