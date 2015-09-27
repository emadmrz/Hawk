<?php

namespace App\Http\Controllers;

use App\Recommendation;
use App\Skill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function store(Request $request, Skill $skill){
        $user = Auth::user();
//        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
//            'author.name' => 'required',
//            'author.description' => 'required',
//        ]);
        $input = $request->all();
        $input['skill_id'] = $skill->id;
        $user->recommendations()->create($input);
        return redirect()->back();
    }
}
