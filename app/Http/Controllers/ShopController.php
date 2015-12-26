<?php

namespace App\Http\Controllers;

use App\Advantage;
use App\Commercial;
use App\File;
use App\Product;
use App\Shop;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Laracasts\Flash\Flash;
use TomLingham\Searchy\Facades\Searchy;

class ShopController extends Controller
{
    public function edit(Shop $shop){
        $advantages = Advantage::get();
        $shop_advantages = $shop->advantages()->lists('advantage_id')->toArray();
        $themes = [
            'danger'=>'قرمز',
            'violet'=>'بنفش',
            'info'=>'آبی روشن',
            'primary'=>'آبی تیره',
            'success'=>'سبز',
        ];
        return view('store.shop.edit', compact('shop', 'advantages', 'shop_advantages', 'themes'))->with(['title'=>'ویرایش فروشگاه']);
    }

    public function update(Shop $shop, Request $request){
        $this->validate($request, [
            'title' => 'required|max:255',
            'logo_image' => 'image',
        ]);
        $input = $request->except('logo_image');
        if($request->hasFile('logo_image')){
            $file = $request->file('logo_image');
            $logo = $this->logo($file, $shop);
            $input['logo'] = $logo;
        }
        $shop->update($input);
        Flash::success('shop info updated');
        return redirect()->back();

    }

    public function advantage(Shop $shop, Request $request){
        if(!$request->has('advantage')){
            $shop->advantages()->detach();
        }else{
            $shop->advantages()->sync($request->input('advantage'));
        }
        Flash::success('Adv  info updated');
        return redirect()->back();
    }

    public function images(Shop $shop){
        return view('store.shop.images', compact('shop'))->with(['title'=>'بنرو تصاویر فروشگاه']);
    }

    public function imagesStore(Shop $shop, Request $request){
        $this->validate($request, [
            'cropper_json' => 'required',
            'inputImage' => 'required|image',
        ]);
        $user = Auth::user();
        $file = $request->file('inputImage');
        $data = $request->input('cropper_json');
        $data = json_decode(stripslashes($data));

        $imageName = $shop->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/shop/'.$shop->id.'/', $imageName);
        $src = public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName;
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB

        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y) );
        $img->resize(1036, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($src, 90);

        $user->usage->add(filesize(public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName)/(1024*1024));// storage add

        $shop->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $shop->id.'/'.$imageName,
            'size'=>$size,
        ]);

        return redirect()->back();
    }

    public function imagesDelete(Request $request){
        File::findOrFail($request->input('id'))->delete();
    }

    public function commercialCreate(Shop $shop){
        $commercials = $shop->commercials()->get();
        return view('store.shop.commercials', compact('shop','commercials'))->with(['title'=>'ثبت آگهی برای فروشگاه']);
    }

    public function commercialStore(Shop $shop, Request $request){
        $this->validate($request, [
            'title' => 'required',
            'url' => 'required',
            'cropper_json' => 'required',
            'inputImage' => 'required|image',
        ]);
        $user = Auth::user();
        $file = $request->file('inputImage');
        $input = $request->only('title', 'url');
        $data = $request->input('cropper_json');
        $data = json_decode(stripslashes($data));

        $imageName = $shop->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/shop/'.$shop->id.'/', $imageName);
        $src = public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName;
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB

        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y) );
        $img->resize(420, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($src, 90);

        $user->usage->add(filesize(public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName)/(1024*1024));// storage add

        $commercial = $shop->commercials()->create($input);
        $commercial->file()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $shop->id.'/'.$imageName,
            'size'=>$size,
        ]);

        return redirect()->back();
    }

    public function commercialDelete(Request $request){

        $commercial = Commercial::findOrFail($request->input('id'));
        $commercial->file()->delete();
        $commercial->delete();
    }

    public function aboutUs(Shop $shop){
        return view('store.shop.aboutus', compact('shop'))->with(['title'=>'درباره ما']);
    }

    public function aboutUsUpdate(Shop $shop, Request $request){
        $shop->update(['about_us'=>$request->input('about_us')]);
        Flash::success('updated successfully');
        return redirect()->back();
    }

    public function contactUs(Shop $shop){
        return view('store.shop.contactus', compact('shop'))->with(['title'=>'ارتباط با ما']);
    }

    public function contactUsUpdate(Shop $shop, Request $request){
        $shop->update(['contact_us'=>$request->input('contact_us')]);
        Flash::success('updated successfully');
        return redirect()->back();
    }

    public function textareaImage(Request $request){
        $user = Auth::user();
        $imageName = str_random(20) . '.' .$request->file('file')->getClientOriginalExtension();
        $request->file('file')->move(public_path() . '/img/files/'.$user->id.'/', $imageName);
        $user->usage->add(filesize(public_path() . '/img/files/'.$user->id.'/'.$imageName)/(1024*1024));// storage add

        return asset('img/files/'.$user->id.'/'.$imageName);
    }

    private function logo($file, $shop){
        $user = Auth::user();
        $imageName = $shop->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/shop/'.$shop->id.'/', $imageName);
        $img = Image::make(public_path().'/img/files/shop/'.$shop->id.'/'.$imageName);
        $img->resize(null, 58, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save(public_path().'/img/files/shop/'.$shop->id.'/'.$imageName, 90);
        $user->usage->add(filesize(public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName)/(1024*1024));// storage add
        return $shop->id.'/'.$imageName;
    }

    /**
     * Created by Emad Mirzaie on 23/10/2015.
     * The shop
     */

    public function home(Shop $shop){
        $shop->visit();
        $top_visit_products = $shop->products()->orderBy('num_visit', 'desc')->get()->take(4);
        $top_comment_products = $shop->products()->orderBy('num_comment', 'desc')->get()->take(4);
        $latest_products = $shop->products()->latest()->get();
        return view('shop.home', compact('shop', 'top_visit_products', 'latest_products', 'top_comment_products'))->with(['title'=>$shop->title]);
    }

    public function aboutUsPage(Shop $shop){
        return view('shop.aboutus', compact('shop'))->with(['title'=>$shop->title]);
    }

    public function contactUsPage(Shop $shop){
        return view('shop.contactus', compact('shop'))->with(['title'=>$shop->title]);
    }

    public function product(Shop $shop, Product $product){
        $user = Auth::user();
        $attributes = $product->attributes()->with('attribute_group')->get();
        $types = $attributes->unique('attribute_group_id');
        $product->visit();
        return view('shop.product', compact('shop', 'product', 'types', 'attributes', 'user'))->with(['title'=>$product->name]);
    }

    public function showroom(Shop $shop, Request $request){
        $products = $shop->products();
        $categories = $shop->products()->with('category')->groupBy('category_id')->get()->pluck('category.name','category.id');
        if($request->has('keyword')){
            $keyword = $request->input('keyword');
            if(!empty($keyword)){
                $products = $products->search($keyword);
            }
        }
        if($request->has('category_id')){
            $category_id = $request->input('category_id');
            if(!empty($category_id) and $category_id != 0){
                $products = $products->where('category_id', $request->input('category_id'));
            }
        }
        if($request->has('order')){
            $order =$this->orderToValue($request->input('order'));
            $products = $products->orderBy($order['field'], $order['order']);
        }
        $products = $products->get();
        $input = $request->all();
        return view('shop.showroom', compact('shop', 'products', 'input', 'categories'))->with(['title'=>$shop->title]);

    }

    private function orderToValue($order_id){
        $orders = [
            1 => ['field'=>'created_at', 'order'=>'desc'],
            2 => ['field'=>'rate', 'order'=>'desc'],
            3 => ['field'=>'num_visit', 'order'=>'desc'],
            4 => ['field'=>'price', 'order'=>'asc']
        ];
        return $orders[$order_id];
    }

    /**
     * Created By Dara on 26/12/2015
     * admin-shop management
     */
    public function adminIndex(User $user){
        $shops=$user->shop()->paginate(20);
        return view('admin.shop.index',compact('shops','user'))->with(['title'=>'User Shop Management']);
    }

    public function adminChange(User $user,Shop $shop){
        if($shop->active==0){ //the shop is already disabled
            $shop->update(['active'=>1]);
            Flash::success(trans('admin/messages.shopActivate'));
        }elseif($shop->active==1){ //the shop is already enabled
            $shop->update(['active'=>0]);
            Flash::success(trans('admin/messages.shopBan'));
        }
        return redirect()->back();
    }

}
