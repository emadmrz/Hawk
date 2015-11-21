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

        return Category::findOrFail($request->input('category_id'))->getDescendants();
    }

    public function tags(Request $request){
        return Tag::where('parent_id', $request->input('sub_category_id'))->get();
    }
}
