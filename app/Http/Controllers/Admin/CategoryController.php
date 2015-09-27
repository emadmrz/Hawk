<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class CategoryController extends Controller
{
    public function index(){
//        $root=Province::create(['name'=>'shiraz']);
//        $root=Province::find(2);
//        $root->children()->create(['name'=>'shirkohi']);
//        $nodes = Province::where(['parent_id'=>null])->get();
//        foreach($nodes as $node) {
//            foreach($node->getDescendantsAndSelf() as $descendant) {
//                echo "{$descendant->name}";
//            }
//        }

        $categories=Category::where(['parent_id'=>null])->get();
        return view('admin.setting.categories', compact('categories'))->with(['title'=>'Categories List/Add New/Edit','hasEdit'=>0]);

    }

    public function categoryCreate (Request $request){
        Category::create(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.categoryAdded'));
        return redirect()->back();
    }

    public function CategoryEdit ($category_edit){
        $categories=Category::where(['parent_id'=>null])->get();
        return view('admin.setting.categories', compact('categories','category_edit'))->with(['title'=>'Categories List/Add New/Edit','hasEdit'=>1]);
    }

    public function CategoryUpdate ($category_edit, Request $request){
        $category_edit->update(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.categoryUpdated'));
        return redirect(route('admin.setting.categories'));
    }

    public function CategoryDelete($category_edit){
        $category_edit->delete();
        Flash::success(trans('admin/messages.categoryDeleted'));
        return redirect(route('admin.setting.categories'));
    }

    public function subCategories($category){
        $sub_categories = $category->getDescendants();
        return view('admin.setting.sub_categories', compact('category','sub_categories'))->with(['title'=>'Sub Category List/Add New/Edit For '.$category->name,'hasEdit'=>0]);
    }

    public function subCategoryCreate($category, Request $request){
        $category->children()->create(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.sub_categoryAdded'));
        return redirect(route('admin.setting.sub_categories',['category'=>$category->id]));
    }

    public function subCategoryEdit ($category, $sub_category_edit){
        $sub_categories = $category->getDescendants();
        return view('admin.setting.sub_categories', compact('sub_categories', 'category','sub_category_edit'))->with(['title'=>'Sub Category List/Add New/Edit','hasEdit'=>1]);
    }

    public function subCategoryUpdate ($category, $sub_category_edit, Request $request){
        $sub_category_edit->update(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.sub_categoryUpdated'));
        return redirect(route('admin.setting.sub_categories',['category'=>$category->id]));
    }

    public function subCategoryDelete($category, $sub_category_edit){
        $sub_category_edit->delete();
        Flash::success(trans('admin/messages.sub_categoryDeleted'));
        return redirect(route('admin.setting.sub_categories',['category'=>$category->id]));
    }

}
