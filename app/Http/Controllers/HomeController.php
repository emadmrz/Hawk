<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return "welcome to skillema Home In this page u will receive feeds from all over the site.";
    }
}
