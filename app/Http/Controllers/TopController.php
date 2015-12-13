<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    public function index(Request $request)
    {
        $firstCategoryQuery = Category::where('parent_id', null);
        $categorySelect = $firstCategoryQuery->lists('name', 'id');
        //search has been activated
        if ($request->has('category') || $request->has('type') || $request->has('sort')) {
            //search operation
            $results=$this->search($request);
        } else {
            if($request->has('show')){ //the show all button is activated
                $limit=20;
                $results=[];
                $firstCategory = Category::where('id', $request->input('show'))->first();
                //building the query
                $results[$firstCategory->id . $firstCategory->name] = $this->userSqlQuery($firstCategory,$limit,$request->input('sort'));
            }else{
                //get all the first-level categories
                $firstCategories = $firstCategoryQuery->get();
                $results = [];
                $limit = 1;
                foreach ($firstCategories as $key => $firstCategory) {
                    //building the query
                    $results[$firstCategory->id . $firstCategory->name]=$this->userSqlQuery($firstCategory,$limit,$request->input('sort'));
                }
            }
        }

        return view('top.index', compact('results'))->with([
            'title' => 'برترین ها',
            'categorySelect' => $categorySelect
        ]);

    }

    private function search(Request $request){
        $this->validate($request, [
            'category' => 'required|integer',
            'type' => 'required|integer|in:1,2',
            'sort' => 'required|integer|in:1,2,3,4'
        ]);
        $limit = 20;
        $results = [];
        $firstCategory = Category::where('id', $request->input('category'))->first();
        //building the query
        $results[$firstCategory->id.$firstCategory->name]=$this->userSqlQuery($firstCategory,$limit,$request->input('sort'));
        return $results;
    }

    private function userSqlQuery($firstCategory,$limit,$sort){
        $q = "SELECT users.*";
        $q = $q . " From `users` LEFT JOIN `skills` ON `users`.`id`=`skills`.`user_id`";
        $q = $q . " LEFT JOIN `categories` ON `categories`.`id`=`skills`.`sub_category_id`";
        $secondCategories = $firstCategory->children()->lists('id')->toArray();
        $c = implode(',', $secondCategories);
        $q = $q . " WHERE `categories`.`id` IN (" . $c . ")";
        $q = $this->userSort($sort,$q);
        //its time to make the results
        $profile=$this->result($q);
        return $profile;
    }

    private function result($q){
        $m = DB::select($q);
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

    private function userSort($sort,$q){
        if($sort==1){ //the sort by rate has been selected
            $q=$q." GROUP BY `users`.`id` ORDER BY `users`.`rate` DESC";
        }elseif($sort==2){ //the sort by profile view has been selected

        }
        return $q;
    }
}
