<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    /**
     * Created By Dara on 13/12/2015
     * show top users in every category
     */
    public function user(){
        $firstCategoryQuery = Category::where('parent_id', null);
        $categorySelect = $firstCategoryQuery->lists('name', 'id');
        $sortSelect=[1=>'پر ستاره ترین ها'];

        $results=[];
        $limit=1;
        $sort=1;
        $type='user';

        //bindings
        $bind=new \stdClass();
        $bind->type=1;

        $firstCategories=$firstCategoryQuery->get();
        foreach($firstCategories as $firstCategory){
            $results[$firstCategory->id.$firstCategory->name]=$this->userSqlQuery($firstCategory,$limit,$sort);
        }
        return view('top.index',compact('results'))->with([
            'title'=>'برترین کاربران',
            'categorySelect'=>$categorySelect,
            'sortSelect'=>$sortSelect,
            'bind'=>$bind,
            'type'=>$type
        ]);
    }

    /**
     * Created By Dara on 13/12/2015
     * show top products in every category
     */
    public function product(){
        $firstCategoryQuery = Category::where('parent_id', null);
        $categorySelect = $firstCategoryQuery->lists('name', 'id');
        $sortSelect = [2 => 'محبوب ترین ها', 3 => 'پر فروش ترین ها', 4 => 'پر بازدید ترین ها'];

        $results=[];
        $limit=1;
        $sort=2;
        $type='product';

        //bindings
        $bind=new \stdClass();
        $bind->type=2;

        $firstCategories=$firstCategoryQuery->get();
        foreach($firstCategories as $firstCategory){
            $results[$firstCategory->id.$firstCategory->name]=$this->ProductSqlQuery($firstCategory,$limit,$sort);
        }
        return view('top.index',compact('results'))->with([
            'title'=>'محصولات برتر',
            'categorySelect'=>$categorySelect,
            'sortSelect'=>$sortSelect,
            'bind'=>$bind,
            'type'=>$type
        ]);
    }

    /**
     * Created By Dara on 13/12/2015
     * show the result of the search
     */
    public function searchProcess(Request $request)
    {
        $this->validate($request, [
            'type' => 'required|integer|in:1,2',
            'sort' => 'required|integer',
            'category' => 'required|integer'
        ]);
        $firstCategoryQuery = Category::where('parent_id', null);
        $categorySelect = $firstCategoryQuery->lists('name', 'id');
        $input = $request->except('_token');
        $results = [];

        //bindings process
        $bind = new \stdClass();
        $bind->type = $input['type'];
        $bind->sort = $input['sort'];
        $bind->category = $input['category'];

        $firstCategory = Category::where('id', $request->input('category'))->first();
        $limit = 20;
        if ($input['type'] == 1) { //search for user is selected
            $type = 'user';
            $sortSelect = [1 => 'پر ستاره ترین ها'];
            $results[$firstCategory->id . $firstCategory->name] = $this->userSqlQuery($firstCategory, $limit, $input['sort']);
        } elseif ($input['type'] == 2) { //search for product selected
            $sortSelect = [2 => 'محبوب ترین ها', 3 => 'پر فروش ترین ها', 4 => 'پر بازدید ترین ها'];
            $results[$firstCategory->id . $firstCategory->name] = $this->productSqlQuery($firstCategory, $limit, $request->input('sort'));
            $type = 'product';
        }
        return view('top.index', compact('results'))->with([
            'title' => 'برترین ها',
            'type' => $type,
            'categorySelect' => $categorySelect,
            'sortSelect' => $sortSelect,
            'bind' => $bind
        ]);
    }

    private function userSqlQuery($firstCategory, $limit, $sort = 1)
    {
        $q = "SELECT users.*";
        $q = $q . " From `users` LEFT JOIN `skills` ON `users`.`id`=`skills`.`user_id`";
        $q = $q . " LEFT JOIN `categories` ON `categories`.`id`=`skills`.`sub_category_id`";
        $secondCategories = $firstCategory->children()->lists('id')->toArray();
        $c = implode(',', $secondCategories);
        $q = $q . " WHERE `categories`.`id` IN (" . $c . ")";
        $q = $this->userSort($sort, $q, $limit);
        //its time to make the results
        $profile = $this->userResult($q);
        return $profile;
    }

    private function userResult($q)
    {
        $m = DB::select($q);
        //dd($m);
        $profile = [];
        foreach ($m as $index => $user) {
            $profile[$index] = new User();
            $profile[$index]->id = $user->id;
            $profile[$index]->first_name = $user->first_name;
            $profile[$index]->last_name = $user->last_name;
            $profile[$index]->status = $user->status;
            $profile[$index]->rate = $user->rate;
            $profile[$index]->company = $user->company;
            $profile[$index]->email = $user->email;
            $profile[$index]->image = $user->image;
            $profile[$index]->confirmed = $user->confirmed;
            $profile[$index]->created_at = $user->created_at;
            $profile[$index]->updated_at = $user->updated_at;
            $profile[$index]->cover = $user->cover;
            $profile[$index]->description = $user->description;
        }
        return $profile;
    }

    private function userSort($sort, $q, $limit)
    {
        if ($sort == 1) { //the sort by rate has been selected
            $q = $q . " GROUP BY `users`.`id` ORDER BY `users`.`rate` DESC LIMIT $limit";
        } else {
            $q = $q . " GROUP BY `users`.`id` ORDER BY `users`.`rate` DESC LIMIT $limit";
        }
        return $q;
    }

    private function productSqlQuery($firstCategory, $limit, $sort)
    {
        //product query
        $secondCategories = $firstCategory->children()->lists('id')->toArray();
        $query = DB::table('products')
            ->leftJoin('skills', 'products.skill_id', '=', 'products.skill_id')
            ->whereIn('products.category_id', $secondCategories);
        $query = $this->productSort($sort, $query, $limit);
        //its time to make the results
        $profile = $this->productResult($query);
        return $profile;
    }

    private function productSort($sort, $query, $limit)
    {
        if ($sort == 2) { //the sort by rate has been selected
            $query = $query->groupBy('products.id')->orderBy('products.rate', 'DESC')->take($limit);
        } elseif ($sort == 3) { //sort by buy_num
            $query = $query->groupBy('products.id')->orderBy('products.num_buy', 'DESC')->take($limit);
        } elseif ($sort == 4) { //sort by num_visit
            $query = $query->groupBy('products.id')->orderBy('products.num_visit', 'DESC')->take($limit);
        } else {
            $query = $query->groupBy('products.id')->orderBy('products.rate', 'DESC')->take($limit);
        }
        return $query;
    }

    private function productResult($query)
    {
        $m = $query->get(['products.*']);
        $profile = [];
        foreach ($m as $index => $product) {
            $profile[$index] = new Product();
            $profile[$index]->id = $product->id;
            $profile[$index]->user_id = $product->user_id;
            $profile[$index]->skill_id = $product->skill_id;
            $profile[$index]->shop_id = $product->shop_id;
            $profile[$index]->category_id = $product->category_id;
            $profile[$index]->name = $product->name;
            $profile[$index]->created_at = $product->created_at;
            $profile[$index]->updated_at = $product->updated_at;
            $profile[$index]->price = $product->price;
            $profile[$index]->discount = $product->discount;
            $profile[$index]->weight = $product->weight;
            $profile[$index]->status = $product->status;
            $profile[$index]->rate = $product->rate;
            $profile[$index]->description = $product->description;
            $profile[$index]->available = $product->available;
            $profile[$index]->num_buy = $product->num_buy;
            $profile[$index]->num_visit = $product->num_visit;
            $profile[$index]->num_comment = $product->num_comment;
        }
        //dd($profile);
        return $profile;
    }
}
