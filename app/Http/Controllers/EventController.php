<?php

namespace App\Http\Controllers;

use App\Event;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Morilog\Jalali\jDate;

class EventController extends Controller
{
    public function index(){
        $events=Event::latest()->where('name','settle')->paginate(20);
        return view('admin.credit.settle.index',compact('events'))->with(['title'=>'Settlement Management']);
    }

    public function create(){
        return view('admin.credit.settle.create')->with(['title'=>'Create Settle']);
    }

    public function store(Request $request){
        $this->validate($request,[
            'from_time'=>'required',
            'to_time'=>'required'
        ]);
        Event::create([
            'name'=>'settle',
            'from_time'=>$request->input('from_time'),
            'to_time'=>$request->input('to_time')
        ]);
        Flash::success(trans('admin\messages.settleCreated'));
        return redirect(route('admin.settle.index'));
    }

    public function delete(Event $event){
        $event->delete();
        Flash::success(trans('admin\messages.settleDeleted'));
        return redirect(route('admin.settle.index'));
    }

    /**
     * Created By Dara on 7/11/2015
     * get nearest settlement shamsi time and check if the user can settle now or not
     */
    public function settleTime(){
        $user=Auth::user();
        //check if the user has an settle with status 0 or not
        $count=$user->settles()->where('status',0)->count();
        $event=Event::where('from_time','<=',date('Y-m-d h-i-s'))
            ->where('to_time','>',date('Y-m-d h-i-s'))
            ->where('name','=','settle')
            ->orWhere('to_time','>',date('Y-m-d h-i-s'))
            ->where('name','settle')
            ->orderBy('from_time','Asc')
            ->first();
        if(count($event)){
            if($event->from_time<date('Y-m-d h-i-s')){ //the current time is between the from and to
                if($count>0){
                    return [
                        'time'=>jDate::forge(date('Y-m-d'))->format('Y/m/d'),
                        'canSettle'=>false,
                        'message'=>'شما درخواست تسویه در حال بررسی دارید!'
                    ];
                }
                return [
                    'time'=>jDate::forge(date('Y-m-d'))->format('Y/m/d'),
                    'canSettle'=>true,
                    'message'=>'هم اکنون می توانید تسویه کنید .'
                ];
            }else{
                return [
                    'time'=>jDate::forge($event->from_time)->format('Y/m/d'),
                    'canSettle'=>false,
                    'message'=>'زمان تسویه فرانرسیده است'
                ];
            }
        }else{
            return [
                'time'=>'نا مشخص',
                'canSettle'=>false,
                'message'=>'رویدادی برای تسویه حساب وجود ندارد.'
            ];
        }
    }

    /**
     * Created By Dara on 7/11/2015
     * settle management view composer
     */
    public function compose(View $view){
        $view->with('settle',$this->settleTime());
    }

}
