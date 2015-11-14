<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(){
        return view('search.index')->with(['title'=>'جستجوی پیشرفته']);
    }

    public function search(){

    }

    public function fastSearch(){

    }
}
