<?php

namespace App\Http\Controllers;

use App\Advantage;
use App\Repositories\StreamRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(StreamRepository $streamRepository)
    {
        $user = Auth::user();
        $feeds = $streamRepository->feed();
        return view('home.home', compact('feeds'))->with(['title' => $user->username]);
    }

    public function profile(User $user)
    {
        $role = $user->roles->first()->slug;
        $advantages = Advantage::get();
        $relatedUsers = $this->relatedUsersM($user);
        $shop = $user->shop;
        if (count($shop)) {
            $advantage_shop = $user->shop->advantages()->lists('advantage_id')->toArray();
        } else {
            $advantage_shop = [];
        }
        return view('home.profile', compact('user', 'role', 'advantages', 'advantage_shop', 'shop', 'relatedUsers'))->with(['title' => $user->first_name]);
    }


    public function relatedUsers(User $user)
    {
        $skills = $user->skills;
        $q = "select users.*, ";
        $count = 0;
        if ($skills->isEmpty()) { // check if the user has skill or not
            $secondCategoryParam = 0;
            $skillParam = 0;
            $count = 2;
        }
        foreach ($skills as $key => $skill) {
            $subCategoryId = $skill->sub_category_id;
            $secondCategoryParam = Config::get('relatedUsers.secondCategoryParam');
            $secondCategoryModified = $secondCategoryParam * 30;
            $title = $skill->title;
            $searches = explode(' ', $title);
            if ($key) {
                $q = $q . ' + ';
            }

            $q = $q . "(case when ";
            foreach ($searches as $index => $search) {
                if ($index) {
                    $q = $q . " || ";
                }
                $q = $q . "skills.title LIKE '" . $search . "'";
            }
            $skillParam = Config::get('relatedUsers.skillParam');
            $modified = $skillParam * 15;
            $q = $q . " then '" . $modified . "' else 0 end) + ";

            $q = $q . "(case when ";
            foreach ($searches as $index => $search) {
                if ($index) {
                    $q = $q . " || ";
                }
                $q = $q . "skills.title LIKE '" . $search . "%'";
            }
            $modified = $skillParam * 5;
            $q = $q . " then '" . $modified . "' else 0 end) + ";

            $q = $q . "(case when ";
            foreach ($searches as $index => $search) {
                if ($index) {
                    $q = $q . " || ";
                }
                $q = $q . "skills.title LIKE '%" . $search . "%'";
            }
            $modified = $skillParam * 2;
            $q = $q . " then '" . $modified . "' else 0 end) + ";
            $skillTot = $skillParam * 30;
            $q = $q . "(case when skills.title LIKE '" . $title . "%' then '" . $skillTot . "' else 0 end)";
            $q = $q . " +(case when skills.sub_category_id=$subCategoryId then '" . $secondCategoryModified . "' else 0 end)";
        }
        $provinceParam = Config::get('relatedUsers.provinceParam');
        $provinceModified = $provinceParam * 30;
        $cityParam = Config::get('relatedUsers.cityParam');
        $cityModified = $cityParam * 30;
        if ($count == 0) {
            $q = $q . " + ";
        }
        $q = $q . "(case when infos.city_id = '" . $user->info->city_id . "' then '" . $cityModified . "' else 0 end) + ";
        $q = $q . "(case when infos.province_id = '" . $user->info->province_id . "' then '" . $provinceModified . "' else 0 end) AS relevance ";
        /**
         * Created by Emad Mirzaie on 28/11/2015.
         * Haj Emad magic!!
         */
        $q = $q . ", IFNULL(relaters.type, 0) as type , (SELECT relevance)*(case when (SELECT type) = 1  then " . Config::get('addonRelater.attributes')[1]['values'][1]['weight'] . " when (SELECT type) = 2 then " . Config::get('addonRelater.attributes')[1]['values'][2]['weight'] . " when (SELECT type) = 3 then " . Config::get('addonRelater.attributes')[1]['values'][3]['weight'] . " else 1 end) as final_result  FROM `users` ";
        $q = $q . "INNER JOIN `skills` ON `users`.`id` = `skills`.`user_id`";
        $q = $q . "INNER JOIN `infos` ON `users`.`id` = `infos`.`user_id`";
        $q = $q . "LEFT JOIN `relaters` ON `users`.`id` = `relaters`.`user_id`";
        $q = $q . " WHERE `users`.`id`!='" . $user->id . "'";
        $q = $q . " GROUP BY users.id";
        $q = $q . " having relevance>" . ($secondCategoryParam + $skillParam + $provinceParam + $cityParam) / (4 - $count);
        /**
         * Created by Emad Mirzaie on 28/11/2015.
         * Order By Affected relevance which is final_result
         */
        $q = $q . " ORDER BY final_result DESC ";
        $q = $q . "LIMIT 20";

        dd($q);
        $users = DB::select($q);

        //dd($users);

        $pp = [];
        foreach ($users as $key => $user) {
            $pp[$key] = new User();
            $pp[$key]->first_name = $user->first_name;
            $pp[$key]->last_name = $user->last_name;
            $pp[$key]->id = $user->id;
            $pp[$key]->email = $user->email;
            $pp[$key]->image = $user->image;
            $pp[$key]->company = $user->company;
            $pp[$key]->description = $user->description;
            $pp[$key]->created_at = $user->created_at;
            $pp[$key]->updated_at = $user->updated_at;
            $pp[$key]->relevance = $user->final_result;

        }

        dd($pp);

    }

    public function relatedUsersM(User $user){
        $skills=$user->skills;
        $count=0;
        $skillParam=Config::get('relatedUsers.skillParam');
        $provinceParam=Config::get('relatedUsers.provinceParam');
        $modifiedProvinceParam=$provinceParam*30;
        $cityParam=Config::get('relatedUsers.cityParam');
        $modifiedCityParam=$cityParam*30;
        $secondCategoryParam=Config::get('relatedUsers.secondCategoryParam');

        $q="SELECT users.*, ";

        if($skills->isempty()){
            $count=2;
            $skillParam=0;
            $secondCategoryParam=0;
        }

        foreach($skills as $key=>$skill){
            $subCategoryId=$skill->sub_category_id;
            $modifiedSubCategoryParam=$secondCategoryParam*30;
            $title=$skill->title;
            $searches=explode(' ',$title);
            if($key){
                $q=$q." + ";
            }
            $q=$q."(case when ";
            $modifiedSkillParam=$skillParam*15;
            foreach($searches as $index=>$search){
                if($index){
                    $q=$q." || ";
                }
                $q=$q."skills.title LIKE '".$search."'";
            }
            $q=$q." then '".$modifiedSkillParam."' else 0 end)";
            $q=$q." + (case when ";
            $modifiedSkillParam=$skillParam*5;
            foreach($searches as $index=>$search){
                if($index){
                    $q=$q." || ";
                }
                $q=$q."skills.title LIKE '".$search."%'";
            }
            $q=$q." then '".$modifiedSkillParam."' else 0 end)";
            $q=$q." + (case when ";
            $modifiedSkillParam=$skillParam*1;
            foreach($searches as $index=>$search){
                if($index){
                    $q=$q." || ";
                }
                $q=$q."skills.title LIKe '%".$search."%'";
            }
            $q=$q." then '".$modifiedSkillParam."' else 0 end)";

            $q=$q." + (case when skills.sub_category_id = '".$subCategoryId."' then '".$modifiedSubCategoryParam."' else 0 end)";
        }
        $q=$q." + (case when infos.province_id = '".$user->info->province_id."' then '".$modifiedProvinceParam."' else 0 end)";
        $q=$q." + (case when infos.province_id = '".$user->info->city_id."' then '".$modifiedCityParam."' else 0 end)";
        $q=$q." AS relevance";
        $q=$q." ,IF(relaters.created_at>'".Carbon::now()->subWeek()."','yes','no') AS test"; //check for expiration of the addon
        $q=$q." , IFNULL(relaters.type,0) AS type , (SELECT relevance)*(case when type = 1 AND (select test)='yes' then '".Config::get('addonRelater.attributes')[1]['values'][1]['weight']."' when type=2 AND (select test)='yes' then '".Config::get('addonRelater.attributes')[1]['values'][2]['weight']."' when type=3 AND (select test)='yes' then '".Config::get('addonRelater.attributes')[1]['values'][2]['weight']."' else 1 end) AS total_relevance";
        $q=$q." FROM users";
        $q=$q." LEFT JOIN `skills` ON `users`.`id` = `skills`.`user_id`";
        $q=$q." LEFT JOIN `infos` ON `users`.`id` = `infos`.`user_id`";
        $q=$q." LEFT JOIN `relaters` ON `users`.`id` = `relaters`.`user_id`";
        $q=$q." WHERE `users`.`id` != '".$user->id."'";
        $q = $q . " GROUP BY users.id";
        $q = $q . " having relevance>" . ($secondCategoryParam + $skillParam + $provinceParam + $cityParam) / (4 - $count);
        $q = $q . " ORDER BY total_relevance DESC ";
        $q = $q . "LIMIT 20";

        $users = DB::select($q);

        //dd($q);
        //dd($users);
        $pp = [];
        foreach ($users as $key => $user) {
            $pp[$key] = new User();
            $pp[$key]->first_name = $user->first_name;
            $pp[$key]->last_name = $user->last_name;
            $pp[$key]->id = $user->id;
            $pp[$key]->email = $user->email;
            $pp[$key]->image = $user->image;
            $pp[$key]->company = $user->company;
            $pp[$key]->description = $user->description;
            $pp[$key]->created_at = $user->created_at;
            $pp[$key]->updated_at = $user->updated_at;
            $pp[$key]->relevance = $user->total_relevance;

        }

        return $pp;
    }

}
