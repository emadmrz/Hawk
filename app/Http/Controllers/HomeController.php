<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return "welcome to skillema Home In this page u will receive feeds from all over the site.";
    }

    public function profile(User $user){
        $role = $user->roles->first()->slug;
        return view('home.profile', compact('user' ,'role'))->with(['title'=> $user->first_name]);
    }

}
