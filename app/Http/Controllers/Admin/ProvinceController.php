<?php

namespace App\Http\Controllers\Admin;

use App\Province;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class ProvinceController extends Controller
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

        $provinces=Province::where(['parent_id'=>null])->get();
        return view('admin.setting.provinces', compact('provinces'))->with(['title'=>'Province List/Add New/Edit','hasEdit'=>0]);

    }

    public function provinceCreate (Request $request){
        Province::create(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.provinceAdded'));
        return redirect()->back();
    }

    public function provinceEdit ($province_edit){
        $provinces=Province::where(['parent_id'=>null])->get();
        return view('admin.setting.provinces', compact('provinces','province_edit'))->with(['title'=>'Province List/Add New/Edit','hasEdit'=>1]);
    }

    public function provinceUpdate ($province_edit, Request $request){
        $province_edit->update(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.provinceUpdated'));
        return redirect(route('admin.setting.provinces'));
    }

    public function provinceDelete($province_edit){
        $province_edit->delete();
        Flash::success(trans('admin/messages.provinceDeleted'));
        return redirect(route('admin.setting.provinces'));
    }

    public function cities($province){
        $cities = $province->getDescendants();
        return view('admin.setting.cities', compact('province','cities'))->with(['title'=>'Cities List/Add New/Edit For '.$province->name,'hasEdit'=>0]);
    }

    public function cityCreate($province, Request $request){
        $province->children()->create(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.cityAdded'));
        return redirect(route('admin.setting.cities',['province'=>$province->id]));
    }

    public function cityEdit ($province, $city_edit){
        $cities = $province->getDescendants();
        return view('admin.setting.cities', compact('cities', 'province','city_edit'))->with(['title'=>'Province List/Add New/Edit','hasEdit'=>1]);
    }

    public function cityUpdate ($province, $city_edit, Request $request){
        $city_edit->update(['name'=>$request->input('name')]);
        Flash::success(trans('admin/messages.cityUpdated'));
        return redirect(route('admin.setting.cities',['province'=>$province->id]));
    }

    public function cityDelete($province, $city_edit){
        $city_edit->delete();
        Flash::success(trans('admin/messages.cityDeleted'));
        return redirect(route('admin.setting.cities',['province'=>$province->id]));
    }

}
