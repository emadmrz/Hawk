<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Comment;
use App\Group;
use App\Post;
use App\Problem;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(){
        $latestArticles=Article::latest()->take(6)->get();
        $latestPosts=Post::latest()->take(6)->get();
        $latestProblems=Problem::latest()->take(6)->get();
        $latestGroups=Group::latest()->take(6)->get();
        $latestUsers=User::latest()->take(6)->get();
        $ratedUsers=User::orderBy('rate','desc')->take(6)->get();
        $chartDatas = Comment::select([
            DB::raw('DATE(created_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get()
            ->toArray();


        return view('admin.dashboard.index',compact('latestArticles','latestPosts','latestProblems','latestGroups','latestUsers','ratedUsers','chartDatas'))->with(['title'=>'Admin Dashboard Panel']);
    }

    public function test(){
        return view('admin.dashboard.test')->with(['title'=>'test']);
    }
}
