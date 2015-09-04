<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
        return "this is your first login and here is your PROFILE";
    }
}
