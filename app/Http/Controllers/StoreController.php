<?php

namespace App\Http\Controllers;

use App\Events\pollPurchased;
use App\Events\questionnairePurchased;
use App\Events\storagePurchased;
use App\Payment;
use App\Storage;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Symfony\Component\HttpFoundation\Response;

class StoreController extends Controller
{

    private $verify;

    public function index(){
        $user = Auth::user();
        return view('store.index', compact('user'))->with(['title'=>'شلوغش کن']);
    }

    public function storage(){
        $user = Auth::user();
        return view('store.storage', compact('user'))->with(['title'=>'افزایش حجم پروفایل']);
    }

    public function storageBuy(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'capacity' => 'required',
            'payment_gate' => 'required | in:mellat,pasargad'
        ]);
        $capacity = $request->input('capacity');
        $price = $this->storagePrice($capacity);
        $volume = Config::get('addonStorage.attributes')[explode('::',$capacity)[0]]['values'][explode('::',$capacity)[1]]['volume'];
        $callback = route('store.storage.buy.callback');
        $description = 'افزایش حجم پروفایل';
        $storage = $user->storages()->create(['capacity'=>$volume, 'status'=>0]);
        $order = $storage->payment()->create([
            'user_id'=>$user->id,
            'amount'=>$price,
            'gateway'=>$request->input('payment_gate'),
            'description'=>$description,
            'status'=> 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback,$orderId,$description,$request->input('payment_gate'));
    }

    public function storageCallback(Request $request){
        $payment = Payment::findOrFail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){ //!empty($this->verify) and $this->verify == 1
            $payment->update(['au'=>$request->input('au')]); // tracking code
            Event::fire(new storagePurchased($payment));
            Flash::success('storage added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.storage'));
        }
    }

    private function storagePrice($capacity){
        $capacity = explode('::', $capacity);
        return (Config::get('addonStorage.base_price')-Config::get('addonStorage.base_price')*Config::get('addonStorage.discount')) + Config::get('addonStorage.attributes')[$capacity[0]]['values'][$capacity[1]]['add_price'];
    }

    public function poll(){
        $user = Auth::user();
        return view('store.poll', compact('user'))->with(['title'=>'افزونه نظر سنجی']);
    }

    public function pollBuy(Request $request){
        $this->validate($request, [
            'scope' => 'required',
            'payment_gate' => 'required | in:mellat,pasargad'
        ]);
        $user = Auth::user();
        $scope = $request->input('scope');
        $price = $this->pollPrice($scope);
        $receivers = Config::get('addonPoll.attributes')[explode('::',$scope)[0]]['values'][explode('::',$scope)[1]]['scope'];
        $callback = route('store.poll.buy.callback');
        $description = 'خرید افزونه نظر سنجی';
        $poll = $user->polls()->create(['scope'=>$receivers, 'status'=>0]);
        $order = $poll->payment()->create([
            'user_id'=>$user->id,
            'amount'=>$price,
            'gateway'=>$request->input('payment_gate'),
            'description'=>$description,
            'status'=> 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback,$orderId,$description,$request->input('payment_gate'));
    }

    public function pollCallback(Request $request){
        $payment = Payment::findOrFail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){ //!empty($this->verify) and $this->verify == 1
            $payment->update(['au'=>$request->input('au')]); // tracking code
            Event::fire(new pollPurchased($payment));
            Flash::success('poll added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.poll'));
        }
    }

    private function pollPrice($scope){
        $scope = explode('::', $scope);
        return (Config::get('addonPoll.base_price')-Config::get('addonPoll.base_price')*Config::get('addonPoll.discount')) + Config::get('addonPoll.attributes')[$scope[0]]['values'][$scope[1]]['add_price'];
    }

    public function questionnaire(){
        $user = Auth::user();
        return view('store.questionnaire', compact('user'))->with(['title'=>'افزونه پرسش نامه']);
    }

    public function questionnaireBuy(Request $request){
        $this->validate($request, [
            'count' => 'required',
            'payment_gate' => 'required | in:mellat,pasargad'
        ]);
        $user = Auth::user();
        $count = $request->input('count');
        $price = $this->questionnairePrice($count);
        $num = Config::get('addonQuestionnaire.attributes')[explode('::',$count)[0]]['values'][explode('::',$count)[1]]['count'];
        $callback = route('store.questionnaire.buy.callback');
        $description = 'خرید افزونه پرسشنامه';
        $questionnaire = $user->questionnaires()->create(['count'=>$num, 'status'=>0]);
        $order = $questionnaire->payment()->create([
            'user_id'=>$user->id,
            'amount'=>$price,
            'gateway'=>$request->input('payment_gate'),
            'description'=>$description,
            'status'=> 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback,$orderId,$description,$request->input('payment_gate'));
    }

    public function questionnaireCallback(Request $request){
        $payment = Payment::findOrFail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){ //!empty($this->verify) and $this->verify == 1
            $payment->update(['au'=>$request->input('au')]); // tracking code
            Event::fire(new questionnairePurchased($payment));
            Flash::success('Questionnaire added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.poll'));
        }
    }

    private function questionnairePrice($count){
        $count = explode('::', $count);
        return (Config::get('addonQuestionnaire.base_price')-Config::get('addonQuestionnaire.base_price')*Config::get('addonQuestionnaire.discount')) + Config::get('addonQuestionnaire.attributes')[$count[0]]['values'][$count[1]]['add_price'];
    }

    public function pay($amount,$callback,$orderId,$description,$gate){
        SoapWrapper::add(function ($service) {
            $service
                ->name('jahanpay')
                ->wsdl('http://www.jahanpay.com/webservice?wsdl');
        });
        $data = [
            $this->gateApiCode($gate), // api name
            $amount, //price in rial
            $callback,
            $orderId,
            urlencode($description)
        ];
        SoapWrapper::service('jahanpay', function ($service) use ($data) {
            $res = $service->call('requestpayment',$data);
            dd(header("Location:http://www.jahanpay.com/pay_invoice/{$res}"));
        });
    }

    public function verify($au, $amount, $gate){
        SoapWrapper::add(function ($service) {
            $service
                ->name('jahanpay')
                ->wsdl('http://www.jahanpay.com/webservice?wsdl');
        });
        $data = [
            $this->gateApiCode($gate), // api name
            $amount, //price in rial
            $au,
        ];
        SoapWrapper::service('jahanpay', function ($service) use ($data) {
            $this->verify = $service->call('verification',$data);
        });
    }

    private function gateApiCode($gate){
        $banks =[
            'mellat'=> 'gt38334g468'
        ];
        return $banks[$gate];
    }

    private function errorCode($code){
        $errorCode = [
            -20=>'api نامعتبر است' ,
            -21=>'آی پی نامعتبر است' ,
            -22=>'مبلغ از کف تعریف شده کمتر است' ,
            -23=>'مبلغ از سقف تعریف شده بیشتر است' ,
            -24=>'مبلغ نامعتبر است' ,
            -6=>'ارتباط با بانک برقرار نشد' ,
            -26=>'درگاه غیرفعال است' ,
            -27=>'آی پی شما مسدود است' ,
            -9=>'خطای ناشناخته' ,
            -29=>'آدرس کال بک خالی است ' ,
            -30=>'چنین تراکنشی یافت نشد' ,
            -31=>'تراکنش انجام نشده ' ,
            -32=>'تراکنش انجام شده اما مبلغ نادرست است ' ,
        ];
        return $errorCode[$code];
    }
}
