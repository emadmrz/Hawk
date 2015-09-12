<?php

namespace App\Http\Controllers\Admin;

use App\Visitor;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function index(){
        $users=DB::table('visitors')->paginate(20);
        return view('admin.visitors.index',compact('users'))->with(['title'=>'visitors']);
    }
}
