<?php

namespace App\Http\Controllers;

use App\Advantage;
use App\Repositories\StreamRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(StreamRepository $streamRepository){
        $user = Auth::user();
        $feeds = $streamRepository->feed();
        return view('home.home', compact('feeds'))->with(['title'=> $user->username]);
    }

    public function profile(User $user){
        $role = $user->roles->first()->slug;
        $advantages = Advantage::get();
        $shop = $user->shop;
        if(count($shop)){ $advantage_shop = $user->shop->advantages()->lists('advantage_id')->toArray();}else{$advantage_shop = [];}
        return view('home.profile', compact('user' ,'role','advantages', 'advantage_shop', 'shop'))->with(['title'=> $user->first_name]);
    }

}
