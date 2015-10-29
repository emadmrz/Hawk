<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AddonsController extends Controller
{
    public function storage(){
        $user = Auth::user();
        $storages = $user->storages()->latest()->get();
        return view('store.storage.index', compact('user', 'storages'))->with(['title'=>'مدیریت حجم های خریداری شده']);

    }

    public function poll(){
        $user = Auth::user();
        $polls = $user->polls()->latest()->get();
        return view('store.poll.index', compact('user', 'polls'))->with(['title'=>'مدیریت نظرسنجی های من']);
    }

    public function questionnaire(){
        $user = Auth::user();
        $questionnaires = $user->questionnaires()->latest()->get();
        return view('store.questionnaire.index', compact('user', 'questionnaires'))->with(['title'=>'مدیریت افزونه پرسشنامه']);
    }

    public function shop(){
        $user = Auth::user();
        $shop = $user->shop;
        return view('store.shop.index', compact('user', 'shop'))->with(['title'=>'مدیریت فروشگاه']);
    }

    public function advertise(){
        $user = Auth::user();
        $advertises = $user->advertises()->latest()->get();
        return view('store.advertise.index', compact('user', 'advertises'))->with(['title'=>'مدیریت تبلیغات در صفحه اول']);
    }
}
