<?php

namespace App\Http\Controllers;

use App\Addon;
use App\User;
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

    /**
     * Created By Dara on 20/10/2015
     * offer management handling
     */
    public function offer(){
        $user=Auth::user();
        $offers=$user->offers()->latest()->get();
        return view('store.offer.index',compact('offers','user'))->with(['title'=>'مدیریت افزونه پیشنهاد ویژه']);
    }

    /**
     * Created By Dara on 29/11/2015
     * relater management handling
     */
    public function relater(){
        $user=Auth::user();
        $relaters=$user->relaters()->latest()->get();
        return view('store.relater.index',compact('relaters','user'))->with(['title'=>'مدیریت افزونه افزایش رتیه پروفایل']);
    }

    /**
     * Created By Dara on 29/11/2015
     * profit management handling
     */
    public function profit(){
        $user=Auth::user();
        $profits=$user->profits()->latest()->get();
        return view('store.profit.index',compact('profits','user'))->with(['title'=>'مدیریت افزونه افزایش رتیه در جستجو']);
    }

    /**
     * Created By Dara on 28/12/2015
     * addon management admin control
     */
    public function adminIndex(User $user){
        $addons=Addon::latest()->lists('name')->toArray(); //get all addon names
        $validAddon=[];
        foreach($addons as $addon){
            $validAddon[]="App\\".ucfirst($addon); //create the itemable_type (APP\Shop ....)
        }
        $payments=$user->payments()
            ->where('status','=',1)
            ->whereIn('itemable_type',$validAddon)
            ->groupBy('itemable_type')
            ->get();
        return view('admin.addon.index',compact('user','payments'))->with(['title'=>'User Addon Management']);
    }
}
