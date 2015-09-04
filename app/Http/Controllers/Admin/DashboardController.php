<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        return "admin Dashboard panel";
    }

    public function test(){
        return view('admin.dashboard.test')->with(['title'=>'test']);
    }
}
