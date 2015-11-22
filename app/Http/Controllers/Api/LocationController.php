<?php

namespace App\Http\Controllers\Api;

use App\Province;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{
    public function cities(Request $request){
            $cities = Province::findOrFail($request->input('province_id'))->getDescendants();
            return $cities;
    }
}
