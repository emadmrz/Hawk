<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeGroup;
use App\Category;
use App\File;
use App\Product;
use App\Shop;
use App\Tag;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(Shop $shop){
        return view('store.shop.product.index', compact('shop'))->with(['title'=>'لیست محصولات فروشگاه']);
    }

    public function create(Shop $shop){
        $user = Auth::user();
        $skills = $user->skills()->lists('title', 'id');
        $main_categories = Category::where('parent_id', null)->lists('name', 'id');
        $sub_categories = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $all_tags = Tag::where('parent_id', key(current($sub_categories)))->lists('name', 'id');

        return view('store.shop.product.create', compact('shop', 'skills', 'main_categories', 'sub_categories', 'all_tags'))->with(['title'=>'ثبت محصول جدید', 'for'=>'create']);
    }

    public function store(Shop $shop, Request $request){
        $user = Auth::user();
        $input = $request->except('tags_list', 'main_category');
        $input['user_id'] = $user->id;
        $product = $shop->products()->create($input);
        $product->tags()->sync($request->input('tags_list'));
        return redirect(route('profile.management.addon.shop.product.edit.step2',[$shop->id, $product->id]));
    }

    public function step1(Shop $shop, Product $product){
        $user = Auth::user();
        $skills = $user->skills()->lists('title', 'id');
        $sub_categories = Category::findOrFail($product->category_id)->getSiblingsAndSelf()->lists('name','id');
        $main_categories = Category::where('parent_id', null)->lists('name', 'id');
        $product['main_category'] = Category::findOrFail($product->category_id)->getRoot()->id;
        $all_tags = Tag::where('parent_id', $product->category_id)->lists('name', 'id');
        return view('store.shop.product.create', compact('shop', 'product', 'skills', 'main_categories', 'sub_categories', 'all_tags'))->with(['title'=>'ثبت محصول جدید', 'for'=>'edit']);
    }

    public function update(Shop $shop, Product $product, Request $request){
        $user = Auth::user();
        $input = $request->except('tags_list', 'main_category', '_token');
        $input['user_id'] = $user->id;
        $shop->products()->update($input);
        $product->tags()->sync($request->input('tags_list'));
        return redirect(route('profile.management.addon.shop.product.edit.step2',[$shop->id, $product->id]));
    }

    public function step2(Shop $shop, Product $product){
        $attribute_groups = AttributeGroup::get();
        return view('store.shop.product.attributes', compact('shop', 'product', 'attribute_groups'))->with(['title'=>'ویرایش محصول']);
    }

    public function attributes(Shop $shop, Product $product, Request $request){
        $product->attributes()->create($request->all());
        return [
            'hasCallback'=>'1',
            'callback'=>'product_attribute_add',
            'hasMsg'=>1,
            'msg'=>'added successfully',
            'returns'=>$product->attributes()->with('Attribute_group')->get()
        ];
    }

    public function attributeDelete(Request $request){
        Attribute::findOrFail($request->input('id'))->delete();
    }

    public function step3(Shop $shop, Product $product){
        return view('store.shop.product.images', compact('shop', 'product'))->with(['title'=>'ویرایش محصول']);
    }

    public function images(Shop $shop, Product $product, Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'inputImage' => 'required | image',
        ]);
        $file = $request->file('inputImage');
        $data = $request->input('cropper_json');
        $data = json_decode(stripslashes($data));

        $imageName = $shop->id.str_random(20) . '.' .$file->getClientOriginalExtension();
        $file->move(public_path() . '/img/files/shop/'.$shop->id.'/', $imageName);
        $real_name = $file->getClientOriginalName();
        $size = $file->getClientSize()/(1024*1024); //calculate the file size in MB
        $src = public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName;

//        $imageName = $this->addImage($file, $shop, $product);

        $img = Image::make($src);
        $img->rotate($data->rotate);
        $img->crop(intval($data->width), intval($data->height), intval($data->x), intval($data->y) );
        $img->resize(400, 400);
        $img->save($src, 90);

        $product->files()->create([
            'user_id' => $user->id,
            'real_name'=>$real_name,
            'name' => $shop->id.'/'.$imageName,
            'size'=>$size,
        ]);
        $user->usage->add(filesize(public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName)/(1024*1024));// storage add

        return redirect()->back();

    }

    public function ImageDelete(Request $request){
        File::findOrFail($request->input('id'))->delete();
    }

    public function calculatePrice(Request $request){
        $product = Product::findOrFail($request->input('product_id'));
        $attributes = $request->input('attribute');
        $add_price = [];
        foreach($attributes as $key=>$attribute){
            $add_price[] = Attribute::findOrFail($attribute)->add_price;
        }
        return [
            'amount' => ($product->price + array_sum($add_price)),
            'final_amount' => (($product->price - $product->price*$product->discount/100) + array_sum($add_price)),
            'discount_amount' => $product->price*$product->discount/100
        ];
    }


//    private function addImage($file, $shop, $product){
//        $user = Auth::user();
//        $imageName = $shop->id.str_random(20) . '.' .$file->getClientOriginalExtension();
//        $file->move(public_path() . '/img/files/shop/'.$shop->id.'/', $imageName);
//        $img = Image::make(public_path().'/img/files/shop/'.$shop->id.'/'.$imageName);
//        $img->resize(420, null, function ($constraint) {
//            $constraint->aspectRatio();
//        });
//        $img->save(public_path().'/img/files/shop/'.$shop->id.'/'.$imageName, 90);
//
//
//
//        $user->usage->add(filesize(public_path() . '/img/files/shop/'.$shop->id.'/'.$imageName)/(1024*1024));// storage add
//        return $shop->id.'/'.$imageName;
//    }
}
