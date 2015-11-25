<?php

namespace App\Http\Controllers;

use App\Advantage;
use App\Repositories\StreamRepository;
use App\User;
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
        $relatedUsers = $this->relatedUsers($user);
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
        $count=0;
        if($skills->isEmpty()){ // check if the user has skill or not
            $skillParam=0;
            $count=1;
        }
        foreach ($skills as $key => $skill) {
            $title = $skill->title;
            $searchs = explode(' ', $title);
            if ($key) {
                $q = $q . ' + ';
            }

            $q = $q . "(case when ";
            foreach ($searchs as $index => $search) {
                if ($index) {
                    $q = $q . " || ";
                }
                $q = $q . "skills.title LIKE '" . $search . "'";
            }
            $skillParam = Config::get('relatedUsers.skillParam');
            $modified = $skillParam * 15;
            $q = $q . " then '" . $modified . "' else 0 end) + ";

            $q = $q . "(case when ";
            foreach ($searchs as $index => $search) {
                if ($index) {
                    $q = $q . " || ";
                }
                $q = $q . "skills.title LIKE '" . $search . "%'";
            }
            $modified = $skillParam * 5;
            $q = $q . " then '" . $modified . "' else 0 end) + ";

            $q = $q . "(case when ";
            foreach ($searchs as $index => $search) {
                if ($index) {
                    $q = $q . " || ";
                }
                $q = $q . "skills.title LIKE '%" . $search . "%'";
            }
            $modified = $skillParam * 2;
            $q = $q . " then '" . $modified . "' else 0 end) + ";
            $skillTot = $skillParam * 30;
            $q = $q . "(case when skills.title LIKE '" . $title . "%' then '" . $skillTot . "' else 0 end)";
        }
        $provinceParam=Config::get('relatedUsers.provinceParam');
        $provinceModified=$provinceParam*30;
        $cityParam=Config::get('relatedUsers.cityParam');
        $cityModified=$cityParam*30;
        if($count==0){
            $q=$q." + ";
        }
        $q = $q . "(case when infos.city_id = '" . $user->info->city_id . "' then '".$cityModified."' else 0 end) + ";
        $q = $q . "(case when infos.province_id = '" . $user->info->province_id . "' then '".$provinceModified."' else 0 end) AS relevance ";
        $q = $q . "FROM `users` ";
        $q = $q . "INNER JOIN `skills` ON `users`.`id` = `skills`.`user_id`";
        $q = $q . "INNER JOIN `infos` ON `users`.`id` = `infos`.`user_id`";
        $q = $q . " WHERE `users`.`id`!='" . $user->id . "'";
        $q = $q . " GROUP BY users.id";
        $q = $q . " having relevance>($skillParam+$provinceParam+$cityParam)/(3-$count) ";
        $q = $q . " ORDER BY relevance DESC ";
        $q = $q . "LIMIT 3";

        //dd($q);
        $users = DB::select($q);
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
            $pp[$key]->relevance = $user->relevance;
        }
        return $pp;
    }

}
