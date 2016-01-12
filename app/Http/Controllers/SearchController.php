<?php

namespace App\Http\Controllers;

use App\Category;
use App\Group;
use App\Product;
use App\Province;
use App\User;
use Bican\Roles\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    private $skillJoin = 0;

    private $shopJoin = 0;

    private $advantageJoin=0;

    public function index(Request $request)
    {
        if ($request->has('query') || $request->has('cat')) {
            $this->validate($request, [
                'query' => 'required|min:3',
                'cat' => 'required|in:users,products'
            ]);
            $catSelected = $request->input('cat');
            //fill the select boxes
            $provinces=[];
            $allProvinces = Province::where('parent_id', null)->lists('name', 'id');
            $provinces[0] = 'اهمیتی ندارد';
            foreach($allProvinces as $key=>$value){
                $provinces[$key]=$value;
            }
            $cities=[];
            $allCities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
            $cities[0] = 'اهمیتی ندارد';
            foreach($allCities as $key=>$value){
                $cities[$key]=$value;
            }
            $firstSkillCat=[];
            $allFirstSkillCat = Category::where('parent_id', null)->lists('name', 'id');
            $firstSkillCat[0] = 'اهمیتی ندارد';
            foreach($allFirstSkillCat as $key=>$value){
                $firstSkillCat[$key]=$value;
            }
            $secondSkillCat=[];
            $allSecondSkillCat = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
            $secondSkillCat[0] = 'اهمیتی ندارد';
            foreach($allSecondSkillCat as $key=>$value){
                $secondSkillCat[$key]=$value;
            }

            if($catSelected=='users'){
                $user = new \stdClass();
                $user->username=$request->input('query');
            }elseif($catSelected=='products'){
                $user = new \stdClass();
                $user->productTitle=$request->input('query');
            }
            $productCat=[];
            $allProductCat=Category::where('depth',1)->lists('name','id');
            $productCat[0]='اهمیتی ندارد';
            foreach($allProductCat as $key=>$value){
                $productCat[$key]=$value;
            }


            //the request has been made outside the fast-search
            return view('search.index')->with([
                'title' => 'جستجوی پیشرفته',
                'catSelected' => $catSelected,
                'provinces' => $provinces,
                'cities' => $cities,
                'firstSkillCat' => $firstSkillCat,
                'secondSkillCat' => $secondSkillCat,
                'productCat'=>$productCat,
                'user' => $user,
                'results'=>[]
            ]);
        } else {
            //fill the select boxes
            $provinces=[];
            $allProvinces = Province::where('parent_id', null)->lists('name', 'id');
            $provinces[0] = 'اهمیتی ندارد';
            foreach($allProvinces as $key=>$value){
                $provinces[$key]=$value;
            }
            $cities=[];
            $allCities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
            $cities[0] = 'اهمیتی ندارد';
            foreach($allCities as $key=>$value){
                $cities[$key]=$value;
            }
            $firstSkillCat=[];
            $allFirstSkillCat = Category::where('parent_id', null)->lists('name', 'id');
            $firstSkillCat[0] = 'اهمیتی ندارد';
            foreach($allFirstSkillCat as $key=>$value){
                $firstSkillCat[$key]=$value;
            }
            $secondSkillCat=[];
            $allSecondSkillCat = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
            $secondSkillCat[0] = 'اهمیتی ندارد';
            foreach($allSecondSkillCat as $key=>$value){
                $secondSkillCat[$key]=$value;
            }
            $user = [];

            $productCat=[];
            $allProductCat=Category::where('depth',1)->lists('name','id');
            $productCat[0]='اهمیتی ندارد';
            foreach($allProductCat as $key=>$value){
                $productCat[$key]=$value;
            }


            //the request has been made outside the fast-search
            return view('search.index')->with([
                'title' => 'جستجوی پیشرفته',
                'catSelected' => 'products',
                'provinces' => $provinces,
                'cities' => $cities,
                'firstSkillCat' => $firstSkillCat,
                'secondSkillCat' => $secondSkillCat,
                'productCat'=>$productCat,
                'user' => $user,
                'results'=>[]
            ]);
        }

    }

    public function search(Request $request)
    {
        //fill the select boxes
        $provinces = Province::where('parent_id', null)->lists('name', 'id');
        $provinces[0] = 'اهمیتی ندارد';
        $cities = Province::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $cities[0] = 'اهمیتی ندارد';
        $firstSkillCat = Category::where('parent_id', null)->lists('name', 'id');
        $firstSkillCat[0] = 'اهمیتی ندارد';
        $secondSkillCat = Category::where('parent_id', null)->firstOrFail()->getDescendants()->lists('name', 'id');
        $secondSkillCat[0] = 'اهمیتی ندارد';
        $catSelected = $request->input('view_d');

        $productCat=Category::where('depth',1)->lists('name','id');
        $productCat[0]='اهمیتی ندارد';

        $user = $this->binding($request);

        if( $request->input('view_d') == 'users'){
            $results = $this->userProccess($request);
        }elseif( $request->input('view_d') == 'products'){
            $results = $this->productProccess($request);
        }


        return view('search.index', compact('user','results'))->with([
            'title' => 'نتایج جستجو',
            'catSelected' => $catSelected,
            'provinces' => $provinces,
            'cities' => $cities,
            'firstSkillCat' => $firstSkillCat,
            'secondSkillCat' => $secondSkillCat,
            'productCat'=>$productCat
        ]);
    }

    public function userProccess(Request $request){
        //search for users
        $query = User::search($request->input('username'), null, true);

        //check for roles
        if($request->has('role'))
            $query = $this->role($request->input('role'), $query);

        //check for province and city
        if($request->has('province') and $request->has('city'))
            $query = $this->province($request->input('province'), $request->input('city'), $query);

        //check for main-category and sub-category in skills
        if($request->has('firstCat') and $request->has('secondCat'))
            $query = $this->skillCategory($request->input('firstCat'), $request->input('secondCat'), $query);

        //check for title of the skill
        if($request->has('title'))
            $query = $this->skillTitle($request->input('title'), $query);

        //check for my_rate in skill section
        if($request->has('my_rate'))
            $query = $this->skillRate($request->input('my_rate'), $query);

        //check for experience in skill
        if($request->has('experience'))
            $query = $this->skillExperience($request->input('experience'), $query);

        //check for degree in experience
        if($request->has('degree'))
            $query=$this->skillDegree($request->input('degree'),$query);

        //check for status in skill
        if($request->has('status'))
            $query=$this->skillStatus($request->input('status'),$query);

        //check for province in skill
        if($request->has('skillCity') and $request->has('skillProvince'))
            $query=$this->skillProvince($request->input('skillProvince'),$request->input('skillCity'),$query);

        //check for week-day in skill
        if($request->has('firstWeekDay') and $request->has('secondWeekDay'))
            $query=$this->skillWeekDay($request->input('firstWeekDay'),$request->input('secondWeekDay'),$query);

        //check for history in skill (years of work)
        if($request->has('history'))
            $query=$this->skillHistory($request->input('history'),$query);

        //left join for profits table
        $query=$query->leftJoin('profits','users.id','=','profits.user_id');

        //sort by the selected parameters
        $query=$this->userSort($request->input('userSort'),$query);

        //finally the results for the user-search ;)
        return $query->get();
    }

    public function productProccess(Request $request){
//search for products
        $query=Product::search($request->input('productTitle'),null,true);

        //check for product category
        $query=$this->productCategory($request->input('productCat'),$query);

        //check for product price
        $query=$this->productPrice($request->input('firstPrice'),$request->input('secondPrice'),$query);

        //check for available products
        $query=$this->productAvailable($request->input('available'),$query);

        //check for image in product
        $query=$this->productImage($request->input('image'),$query);

        //check for discount in product
        $query=$this->productDiscount($request->input('discount'),$query);

        //check for shop name in products
        $query=$this->shopTitle($request->input('shopTitle'),$query);

        //check for product return in shop
        $query=$this->productReturn($request->input('productReturn'),$query);

        //check for pay in home in shop
        $query=$this->productPayInHome($request->input('payInHome'),$query);

        //check for product guarantee in shop
        $query=$this->productGuarantee($request->input('productGuarantee'),$query);

        //check for product original in shop
        $query=$this->productOriginal($request->input('productOriginal'),$query);

        //check for product fast deliver in shop
        $query=$this->productFastDeliver($request->input('fastDeliver'),$query);

        //check for product province and city
        $query=$this->productProvince($request->input('productProvince'),$request->input('productCity'),$query);

        //sort by the selected parameters
        $query=$this->productSort($request->input('productSort'),$query);

        //finally the result for product search
        return $query->get();
    }

    public function binding($request){
        //the user selected options
        $user = new \stdClass();
        $user->view_d=$request->input('view_d');
        $user->username = $request->input('username');
        $user->role = $request->input('role');
        $user->province = $request->input('province');
        $user->city = $request->input('city');
        $user->firstCat = $request->input('firstCat');
        $user->secondCat = $request->input('secondCat');
        $user->title = $request->input('title');
        $user->my_rate = $request->input('my_rate');
        $user->experience = $request->input('experience');
        $user->degree=$request->input('degree');
        $user->status=$request->input('status');
        $user->skillProvince=$request->input('skillProvince');
        $user->skillCity=$request->input('skillCity');
        $user->firstWeekDay=$request->input('firstWeekDay');
        $user->secondWeekDay=$request->input('secondWeekDay');
        $user->history=$request->input('history');
        $user->userSort=$request->input('userSort');

        $user->productCat=$request->input('productCat');
        $user->firstPrice=$request->input('firstPrice');
        $user->secondPrice=$request->input('secondPrice');
        $user->available=$request->input('available');
        $user->image=$request->input('image');
        $user->discount=$request->input('discount');
        $user->shopTitle=$request->input('shopTitle');
        $user->productReturn=$request->input('productReturn');
        $user->payInHome=$request->input('payInHome');
        $user->productGuarantee=$request->input('productGuarantee');
        $user->productOriginal=$request->input('productOriginal');
        $user->fastDeliver=$request->input('fastDeliver');
        $user->productProvince=$request->input('productProvince');
        $user->productCity=$request->input('productCity');
        $user->productSort=$request->input('productSort');

        return $user;
    }

    public function fastSearch(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|min:3',
            'section' => 'required|in:users,products'
        ]);

        //adding group search
        $groupResults=Group::search($request->input('query'),null,true)->get();

        if ($request->input('section') == 'users') {
            $query = User::search($request->input('query'), null, true);
            $query->leftJoin('profits','users.id','=','profits.user_id');
            $query=$query->select(DB::raw("IF(profits.created_at>'".Carbon::now()->subWeek()."','yes','no') AS test,IFNULL(`profits`.`type`,0) AS type,(SELECT relevance)*(case when type=1 AND (SELECT test)='yes' then  '".Config::get('addonProfit.attributes')[1]['values'][1]['weight']."' when type=2 AND (SELECT test)='yes' then '".Config::get('addonProfit.attributes')[1]['values'][2]['weight']."' when type=3 AND (SELECT test)='yes' then '".Config::get('addonProfit.attributes')[1]['values'][3]['weight']."' else 1 end) AS total_relevance"))->addSelect('users.*')->groupBy('users.id')->orderBy('total_relevance','DESC');
            $results=$query->get();
        } elseif ($request->input('section') == 'products') {
            $query = Product::search($request->input('query'), null, true);
            $results = $query->groupBy('products.id')->get();
        }
        $return = view('search.partials.fastResult', compact('results'),compact('groupResults'))->with(['section' => $request->input('section')])->render();

        return [
            'hasCallback' => 1,
            'callback' => 'search_fast',
            'hasMsg' => 0,
            'msg' => '',
            'msgType' => '',
            'returns' => $return

        ];
    }

    /**
     * Created By Dara on 16/11/2015
     * managing the search made by role
     */
    private function role($role, $query)
    {
        if ($role != 0) {
            if ($role == 1) { // the user is normal not legal
                $query = $query->join('role_user', function ($join) {
                    $join->on('users.id', '=', 'role_user.user_id')
                        ->where('role_id', '=', 2);
                });
            } elseif ($role == 2) { // the user is legal
                $query = $query->join('role_user', function ($join) {
                    $join->on('users.id', '=', 'role_user.user_id')
                        ->where('role_id', '=', 3);
                });
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 16/11/2015
     * managing the search made by province
     */
    private function province($province, $city, $query)
    {
        if ($province != 0) {
            if ($city != 0) { // the city selected as well
                $query = $query->join('infos', function ($join) use ($province, $city) {
                    $join->on('users.id', '=', 'infos.user_id')
                        ->where('infos.province_id', '=', $province)
                        ->where('infos.city_id', '=', $city);
                });
            } else { // the province selected but the city doesnt matter (non-selected)
                $query = $query->join('infos', function ($join) use ($province, $city) {
                    $join->on('users.id', '=', 'infos.user_id')
                        ->where('infos.province_id', '=', $province);
                });
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 17/11/2015
     * managing the search made by skill categories
     */
    private function skillCategory($firstSkillCat, $secondSkillCat, $query)
    {
        if ($firstSkillCat != 0) { //the user has chosen the first skill cat
            if ($secondSkillCat != 0) { // the second skill cat selected as well
                $query = $query->join('skills', function ($join) use ($secondSkillCat) {
                    $join->on('users.id', '=', 'skills.user_id')
                        ->where('skills.sub_category_id', '=', $secondSkillCat);
                });
                $this->skillJoin += 1;
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 18/11/2015
     * managing the search for skill title
     */
    private function skillTitle($title, $query)
    {
        if ($title != null) { // user selected title for skill
            if ($this->skillJoin == 0) { // the join has not been made for skill yet
                $query = $query->join('skills', function ($join) use ($title) {
                    $join->on('users.id', '=', 'skills.user_id')
                        ->where('skills.title', 'LIKE', "%$title%");
                });
                $this->skillJoin +=1;
            } else { // the join for skill table has already been made
                $query = $query->where('skills.title', 'LIKE', "%$title%");
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 18/11/2015
     * managing the search for skill rate
     */
    private function skillRate($rate, $query)
    {
        if ($rate != 0) { // user has selected the rate for the skill
            if ($this->skillJoin == 0) { // the join has not been made for skill yet
                $query = $query->join('skills', function ($join) use ($rate) {
                    $join->on('users.id', '=', 'skills.user_id')
                        ->where('skills.my_rate', '=', $rate);
                });
                $this->skillJoin += 1;
            } else { // the join for skill table has already been made
                $query = $query->where('skills.my_rate', '=', $rate);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 18/11/2015
     * managing the search for skill experience
     */
    private function skillExperience($experience, $query)
    {
        if ($experience != null) { // the user has selected the experience
            if ($this->skillJoin == 0) { // the join has not been made for skill yet
                $query = $query->join('skills','users.id','=','skills.user_id')
                    ->join('experiences','skills.id','=','experiences.skill_id');
                $this->skillJoin+=1;
            }else{ // the join for skill table has already been made
                $query=$query->join('experiences','skills.id','=','experiences.skill_id');
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 18/11/2015
     * managing the search for skill degree
     */
    private function skillDegree($degree,$query){
        if($degree!=null){ // the user has selected the degree
            if($this->skillJoin==0){ // the join has not been made for skill yet
                $query=$query->join('skills','users.id','=','skills.user_id')
                    ->join('degrees','skills.id','=','degrees.skill_id');
                $this->skillJoin+=1;
            }else{ // the join for skill table has already been made
                $query=$query->join('degrees','skills.id','=','degrees.skill_id');
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 18/11/2015
     * managing the search for skill status
     */
    private function skillStatus($status,$query){
        if($status==1){ // the status for user has been selected
            if($this->skillJoin==0){ // the join has not been made for skill yet
                $query=$query->join('skills','users.id','=','skills.user_id')
                    ->where('skills.status','=',1);
                $this->skillJoin+=1;
            }else{ // the join for skill table has already been made
                $query=$query->where('skills.status','=',1);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 18/11/2015
     * managing province and city for skill
     */
    private function skillProvince($province,$city,$query){
        if($province!=0){ // province for skill has been selected
            if($city!=0){ // the city has been selected as well
                if($this->skillJoin==0){ // the join has not been made for skill yet
                    $query=$query->join('skills','users.id','=','skills.user_id')
                        ->join('areas','skills.id','=','areas.skill_id')
                        ->where('areas.city_id','=',$city);
                    $this->skillJoin+=1;
                }else{ // the join for skill table has already been made
                    $query=$query->join('areas','skills.id','=','areas.skill_id')
                        ->where('areas.city_id','=',$city);
                }
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the week-day for skill
     */
    private function skillWeekDay($firstWeekDay,$secondWeekDay,$query){
        if($firstWeekDay!=0){
            if($this->skillJoin==0){ // the join has not been made for skill yet
                $query=$query->join('skills','users.id','=','skills.user_id')
                    ->join('schedules','skills.id','=','schedules.skill_id')
                    ->whereBetween('schedules.week_day',[$firstWeekDay,$secondWeekDay]);
            }else{ // the join for skill table has already been made
                $query=$query->join('schedules','skills.id','=','schedules.skill_id')
                    ->whereBetween('week_day',[$firstWeekDay,$secondWeekDay]);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the history for skill
     */
    private function skillHistory($history,$query){
        if($history==1){ //history has been selected
            if($this->skillJoin==0){ // the join has not been made for skill yet
                $query=$query->join('skills','users.id','=','skills.user_id')
                    ->join('histories','skills.id','=','histories.skill_id');
                $this->skillJoin+=1;
            }else{ // the join for skill table has already been made
                $query=$query->join('histories','skills.id','histories.skill_id');
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * sorting the user-search
     */
    private function userSort($sort,$query){
        $query=$query->addSelect(DB::raw("IF(profits.created_at>'".Carbon::now()->subWeek()."','yes','no') AS has_profit,IFNULL(`profits`.`type`,0) AS profit_type,(SELECT relevance)*(case when (SELECT profit_type) = 1 AND (SELECT has_profit)='yes' then  '".Config::get('addonProfit.attributes')[1]['values'][1]['weight']."' when (SELECT profit_type) = 2 AND (SELECT has_profit)='yes' then '".Config::get('addonProfit.attributes')[1]['values'][2]['weight']."' when (SELECT profit_type)=3 AND (SELECT has_profit)='yes' then '".Config::get('addonProfit.attributes')[1]['values'][3]['weight']."' else 1 end) AS total_relevance"))->addSelect('users.*');
        $query = $query->orderBy('total_relevance','DESC');
        if($sort==2){ //sort by the created_at selected
            $query=$query->orderBy('created_at','ASC');
        }elseif($sort==1){ //sort by the user skill rate
            if($this->skillJoin==0){ // the join has not been made for skill yet
                $query=$query->join('skills','users.id','=','skills.user_id')
                    ->orderBy('skills.my_rate','DESC');
            }else{ //the join for skill table has already been made
                $query=$query->orderBy('skills.my_rate','DESC');
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the category for product
     */
    private function productCategory($category,$query){
        if($category!=0){ //user has selected category for product
            $query=$query->where('category_id','=',$category);
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the price for product
     */
    private function productPrice($firstPrice,$secondPrice,$query){
        if($firstPrice!=null && $secondPrice!=null){
            $query=$query->whereBetween('price',[intval($firstPrice),intval($secondPrice)]);
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the available products
     */
    private function productAvailable($available,$query){
        if($available==1){
            $query=$query->where('available','=',1);
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the image for products
     */
    private function productImage($image,$query){
        if($image==1){
            $query=$query->join('files','files.imageable_id','=','products.id')
                ->where('files.imageable_type','=','App\Product')
                ->select('products.*');
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the discount for product
     */
    private function productDiscount($discount,$query){
        if($discount==1){
            $query=$query->where('discount','>',0);
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the shop name
     */
    private function shopTitle($title,$query){
        if($title!=null){
            if($this->shopJoin==0){
                $query=$query->join('shops','products.shop_id','=','shops.id')
                    ->where('title','LIKE',"%$title%");
                $this->shopJoin+=1;
            }else{
                $query=$query->where('title','LIKE',"%$title%");
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the product return
     */
    private function productReturn($return,$query){
        if($return==4){
            if($this->advantageJoin==0){
                $query=$query->join('advantage_shop','products.shop_id','=','advantage_shop.shop_id')
                    ->where('advantage_shop.advantage_id','=',4);
                $this->advantageJoin+=1;
            }else{
                $query=$query->where('advantage_shop.advantage_id','=',4);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the pay in home
     */
    private function productPayInHome($pay,$query){
        if($pay==6){
            if($this->advantageJoin==0){
                $query=$query->join('advantage_shop','products.shop_id','=','advantage_shop.shop_id')
                    ->where('advantage_shop.advantage_id','=',6);
                $this->advantageJoin+=1;
            }else{
                $query=$query->where('advantage_shop.advantage_id','=',6);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the product guarantee
     */
    private function productGuarantee($guarantee,$query){
        if($guarantee==4){
            if($this->advantageJoin==0){
                $query=$query->join('advantage_shop','products.shop_id','=','advantage_shop.shop_id')
                    ->where('advantage_shop.advantage_id','=',3);
                $this->advantageJoin+=1;
            }else{
                $query=$query->where('advantage_shop.advantage_id','=',3);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the product original
     */
    private function productOriginal($original,$query){
        if($original==2){
            if($this->advantageJoin==0){
                $query=$query->join('advantage_shop','products.shop_id','=','advantage_shop.shop_id')
                    ->where('advantage_shop.advantage_id','=',2);
                $this->advantageJoin+=1;
            }else{
                $query=$query->where('advantage_shop.advantage_id','=',2);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * managing the fast deliver
     */
    private function productFastDeliver($fast,$query){
        if($fast==1){
            if($this->advantageJoin==0){
                $query=$query->join('advantage_shop','products.shop_id','=','advantage_shop.shop_id')
                    ->where('advantage_shop.advantage_id','=',1);
                $this->advantageJoin+=1;
            }else{
                $query=$query->where('advantage_shop.advantage_id','=',1);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 21/11/2015
     * managing the product province and city
     */
    private function productProvince($province,$city,$query){
        if($province!=0){
            if($city!=0){
                $query=$query->join('users','products.user_id','=','users.id')
                    ->join('infos','users.id','=','infos.user_id')
                    ->where('province_id','=',$province)
                    ->where('city_id','=',$city);
            }else{
                $query=$query->join('users','products.user_id','=','users.id')
                    ->join('infos','users.id','=','infos.user_id')
                    ->where('province_id','=',$province);
            }
        }
        return $query;
    }

    /**
     * Created By Dara on 19/11/2015
     * sorting the product-search
     */
    private function productSort($sort,$query){
        if($sort==1){
            $query=$query->groupBy('products.id')->orderBy('products.num_visit','DESC');
        }elseif($sort==2){
            $query=$query->groupBy('products.id')->orderBy('products.rate','DESC');
        }elseif($sort==3){
            $query=$query->groupBy('products.id')->orderBy('products.num_buy','DESC');
        }elseif($sort==4){
            $query=$query->groupBy('products.id')->orderBy('products.price','ASC');
        }elseif($query==5){
            $query=$query->groupBy('products.id')->orderBy('products.created_at','DESC');
        }
        return $query;
    }
}
