<?php

namespace App\Http\Controllers;


use App\Events\offerPurchased;
use App\Addon;
use App\Advertise;
use App\Events\advertisePurchased;
use App\Events\pollPurchased;
use App\Events\questionnairePurchased;
use App\Events\relaterPurchased;
use App\Events\shopPurchased;
use App\Events\storagePurchased;
use App\Payment;
use App\Repositories\FriendRepository;
use App\Storage;
use App\Stream;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;
use Morilog\Jalali\jDate;
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
        $storage = Addon::storage()->first();
        return view('store.storage', compact('user', 'storage'))->with(['title'=>'افزایش حجم پروفایل']);
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
            $this->stream($payment);
            Flash::success('storage added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.storage'));
        }
    }

    public function storagePriceCalculator(Request $request){
        $capacity = $request->input('capacity');
        $final_amount = $this->storagePrice($capacity);
        $capacity = explode('::', $capacity);
        $base_amount = Config::get('addonStorage.base_price') + Config::get('addonStorage.attributes')[$capacity[0]]['values'][$capacity[1]]['add_price'];
        $discount_amount = Config::get('addonStorage.base_price')*Config::get('addonStorage.discount');
        return compact('final_amount', 'base_amount', 'discount_amount');
    }

    private function storagePrice($capacity){
        $capacity = explode('::', $capacity);
        return (Config::get('addonStorage.base_price')-Config::get('addonStorage.base_price')*Config::get('addonStorage.discount')) + Config::get('addonStorage.attributes')[$capacity[0]]['values'][$capacity[1]]['add_price'];
    }

    public function poll(){
        $user = Auth::user();
        $poll = Addon::poll()->first();
        return view('store.poll', compact('user', 'poll'))->with(['title'=>'افزونه نظر سنجی']);
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
            $this->stream($payment);
            Flash::success('poll added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.poll'));
        }
    }

    public function pollPriceCalculator(Request $request){
        $scope = $request->input('scope');
        $final_amount = $this->pollPrice($scope);
        $scope = explode('::', $scope);
        $base_amount = Config::get('addonPoll.base_price') + Config::get('addonPoll.attributes')[$scope[0]]['values'][$scope[1]]['add_price'];
        $discount_amount = Config::get('addonPoll.base_price')*Config::get('addonPoll.discount');
        return compact('final_amount', 'base_amount', 'discount_amount');
    }

    private function pollPrice($scope){
        $scope = explode('::', $scope);
        return (Config::get('addonPoll.base_price')-Config::get('addonPoll.base_price')*Config::get('addonPoll.discount')) + Config::get('addonPoll.attributes')[$scope[0]]['values'][$scope[1]]['add_price'];
    }

    public function questionnaire(){
        $user = Auth::user();
        $questionnaire = Addon::questionnaire()->first();
        return view('store.questionnaire', compact('user', 'questionnaire'))->with(['title'=>'افزونه پرسش نامه']);
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
            $this->stream($payment);
            Flash::success('Questionnaire added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.poll'));
        }
    }

    public function questionnairePriceCalculator(Request $request){
        $count = $request->input('count');
        $final_amount = $this->questionnairePrice($count);
        $count = explode('::', $count);
        $base_amount = Config::get('addonQuestionnaire.base_price') + Config::get('addonQuestionnaire.attributes')[$count[0]]['values'][$count[1]]['add_price'];
        $discount_amount = Config::get('addonQuestionnaire.base_price')*Config::get('addonQuestionnaire.discount');
        return compact('final_amount', 'base_amount', 'discount_amount');
    }

    private function questionnairePrice($count){
        $count = explode('::', $count);
        return (Config::get('addonQuestionnaire.base_price')-Config::get('addonQuestionnaire.base_price')*Config::get('addonQuestionnaire.discount')) + Config::get('addonQuestionnaire.attributes')[$count[0]]['values'][$count[1]]['add_price'];
    }

    public function shop(){
        $user = Auth::user();
        $shop = Addon::shop()->first();
        return view('store.shop', compact('user', 'shop'))->with(['title'=>'فروشگاه ساز']);
    }

    public function shopBuy(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'payment_gate' => 'required | in:mellat,pasargad'
        ]);
        $callback = route('store.shop.buy.callback');
        $description = 'افزونه فروشگاه ساز';
        $price = $this->shopPrice();
        $shop = $user->shop()->create(['status'=>0]);
        $order = $shop->payment()->create([
            'user_id'=>$user->id,
            'amount'=>$price,
            'gateway'=>$request->input('payment_gate'),
            'description'=>$description,
            'status'=> 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback,$orderId,$description,$request->input('payment_gate'));
    }

    public function shopCallback(Request $request){
        $payment = Payment::findOrFail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){ //!empty($this->verify) and $this->verify == 1
            $payment->update(['au'=>$request->input('au')]); // tracking code
            Event::fire(new shopPurchased($payment));
            $this->stream($payment);
            Flash::success('shop added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.shop'));
        }
    }

    private function shopPrice(){
        return Config::get('addonShop.base_price');
    }

    public function advertise(){
        $user = Auth::user();
        $advertise = Addon::advertise()->first();
        $reservation_dates = $this->advertiseAvailableList();
        return view('store.advertise', compact('user', 'advertise', 'reservation_dates'))->with(['title'=>'تبلیغات در صفحه اول']);
    }

    private function advertiseAvailableList(){
        $advertises = Advertise::where('expired_at', '>', Carbon::now())->active()->get();
        $reservation_dates=[];
        $columns = Config::get('addonAdvertise.columns');
        for($i=1; $i<=15; $i++){
            $capacity = $columns;
            $start_date = Carbon::now()->addDays($i-1);
            $expire_date = Carbon::now()->addDays($i);
            $selected_advertises = $advertises->filter(function ($advertise) use ($start_date, $expire_date) {
                return ($advertise->expired_at > $start_date and $advertise->expired_at < $expire_date);
            });
            foreach($selected_advertises as $selected_advertise){
                $weight = Config::get('addonAdvertise.attributes')[1]['values'][$selected_advertise->type]['weight'];
                $capacity = $capacity - $weight;
            }
            if($capacity-Config::get('addonAdvertise.attributes')[1]['values'][1]['weight'] >= 0){ $gold_availability = 1;}else{$gold_availability = 0;}
            if($capacity-Config::get('addonAdvertise.attributes')[1]['values'][2]['weight']>= 0){$silver_availability = 1;}else{$silver_availability = 0;}
            if($capacity-Config::get('addonAdvertise.attributes')[1]['values'][3]['weight'] >= 0){$bronze_availability = 1;}else{$bronze_availability = 0;}
            $selected_advertises = $selected_advertises->all();
            $expire_date = jDate::forge($expire_date)->format('Y/m/d H:i');
            $start_date = jDate::forge($start_date)->format('Y/m/d H:i');
            $reservation_dates[$i] = compact('start_date', 'expire_date', 'gold_availability', 'silver_availability', 'bronze_availability', 'selected_advertises');
        }
        return $reservation_dates;
    }

    public function advertiseBuy(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'reserve' => 'required',
            'payment_gate' => 'required | in:mellat,pasargad'
        ]);
        $reserves = $request->input('reserve');
        $package_group = str_random(5);
        $advertise = null;
        foreach($reserves as $key=>$reserve){
            $info = explode('::', $reserve);
            if(is_null($advertise)){
                $advertise = $user->advertises()->create(['type'=>$info[1], 'package'=>$package_group, 'status'=>0, 'expired_at'=>Carbon::now()->addDays($info[0])]);
            }else{
                $user->advertises()->create(['type'=>$info[1], 'package'=>$package_group, 'status'=>0, 'expired_at'=>Carbon::now()->addDays($info[0])]);
            }
        }
        $price = $this->advertisePrice($reserves);
        $callback = route('store.advertise.buy.callback');
        $description = 'تبلیغات در صفحه اول';
        $order = $advertise->payment()->create([
            'user_id'=>$user->id,
            'amount'=>$price,
            'gateway'=>$request->input('payment_gate'),
            'description'=>$description,
            'status'=> 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback,$orderId,$description,$request->input('payment_gate'));
    }

    public function advertiseCallback(Request $request){
        $payment = Payment::findOrFail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){ //!empty($this->verify) and $this->verify == 1
            $payment->update(['au'=>$request->input('au')]); // tracking code
            Event::fire(new advertisePurchased($payment));
            $this->stream($payment);
            Flash::success('advertise added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.storage'));
        }
    }

    public function advertisePriceCalculator(Request $request){
        if(!$request->has('reserve')){ return false; }
        $reserves = $request->input('reserve');
        $base_amount = 0;
        foreach($reserves as $reserve){
            $info = explode('::',$reserve);
            $base_amount = $base_amount + Config::get('addonAdvertise.attributes')[1]['values'][$info[1]]['add_price'];
        }
        $final_amount = $base_amount-(Config::get('addonAdvertise.discount')*$base_amount);
        $discount_amount = ($base_amount*Config::get('addonAdvertise.discount'));
        return compact('final_amount', 'base_amount', 'discount_amount');
    }

    private function advertisePrice($reserves){
        $base_amount = 0;
        foreach($reserves as $reserve){
            $info = explode('::',$reserve);
            $base_amount = $base_amount + Config::get('addonAdvertise.attributes')[1]['values'][$info[1]]['add_price'];
        }
        $final_amount = $base_amount-(Config::get('addonAdvertise.discount')*$base_amount);
        return $final_amount;
    }

    private function advertiseAvailability($type, $reserve){
        $advertises = Advertise::select([
            DB::raw('DATE(expired_at) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])
            ->where('status',1)
            ->where('type',$type[1])
            ->whereBetween('expired_at', [Carbon::now(), Carbon::now()->addDays($reserve)])
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
        return $advertises;

    }

//    CONFLICTS SOLVE


    /*
     * Created By Dara on 19/10/2015
     * special offers handling
     */
    public function offer()
    {
        $user = Auth::user();
        $offer = Addon::offer()->first();
        return view('store.offer', compact('user','offer'))->with(['title' => 'پیشنهاد ویژه']);
    }

    public function offerBuy(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'payment_gate' => 'required|in:mellat,pasaragad'
        ]);
        $description = "پیشنهاد ویژه پروفایل";
        $price = $this->offerPrice();
        $callback = route('store.offer.buy.callback');
        $offer = $user->offers()->create(['status'=>0]);
        $order = $offer->payment()->create([
            'user_id' => $user->id,
            'amount' => $price,
            'gateway' => $request->input('payment_gate'),
            'description' => $description,
            'status' => 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback, $orderId, $description, $request->input('payment_gate'));
    }


    public function offerCallback(Request $request)
    {
        $payment = Payment::findOrfail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){
            $payment->update(['au' => $request->input('au')]); // tracking code
            Event::fire(new offerPurchased($payment));
            $this->stream($payment);
            Flash::success('offer added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.offer'));
        }
    }

    private function offerPrice()
    {
        return (Config::get('addonOffer.base_price') - config::get('addonOffer.base_price') * config::get('addonOffer.discount'));
    }

    /**
     * Created By Dara on 27/11/2015
     * relater addon handling
     */
    public function relater(){
        $user=Auth::user();
        $relater=Addon::relater()->first();
        return view('store.relater',compact('user','relater'))->with(['title'=>'افزایش رتبه در جستجو']);
    }

    public function relaterBuy(Request $request){
        $user = Auth::user();
        $this->validate($request, [
            'type' => 'required',
            'payment_gate' => 'required | in:mellat,pasargad'
        ]);
        $type = $request->input('type');
        $price = $this->storagePrice($type);
        $qualification = Config::get('addonRelater.attributes')[explode('::',$type)[0]]['values'][explode('::',$type)[1]]['qualification'];
        $callback = route('store.relater.buy.callback');
        $description = 'افزایش رتبه در جستجو پروفایل';
        $relater = $user->relaters()->create(['type'=>$qualification, 'status'=>0]);
        $order = $relater->payment()->create([
            'user_id'=>$user->id,
            'amount'=>$price,
            'gateway'=>$request->input('payment_gate'),
            'description'=>$description,
            'status'=> 0
        ]);
        $orderId = $order->id;
        $this->pay($price, $callback,$orderId,$description,$request->input('payment_gate'));
    }

    public function relaterPriceCalculator(Request $request){
        $type = $request->input('type');
        $final_amount = $this->relaterPrice($type);
        $type = explode('::', $type);
        $base_amount = Config::get('addonRelater.base_price') + Config::get('addonRelater.attributes')[$type[0]]['values'][$type[1]]['add_price'];
        $discount_amount = Config::get('addonRelater.base_price')*Config::get('addonRelater.discount');
        return compact('final_amount', 'base_amount', 'discount_amount');
    }

    private function relaterPrice($type){
        $type = explode('::', $type);
        return (Config::get('addonRelater.base_price')-Config::get('addonRelater.base_price')*Config::get('addonRelater.discount')) + Config::get('addonRelater.attributes')[$type[0]]['values'][$type[1]]['add_price'];
    }

    public function relaterCallback(Request $request){
        $payment = Payment::findOrFail($request->input('order_id'));
        $this->verify($request->input('au'), $payment->amount, $payment->gateway);
        if(true){ //!empty($this->verify) and $this->verify == 1
            $payment->update(['au'=>$request->input('au')]); // tracking code
            Event::fire(new relaterPurchased($payment));
            $this->stream($payment);
            Flash::success('relater added successfully');
            return redirect(route('store.index'));
        }else{
            Flash::error($this->errorCode($this->verify));
            return redirect(route('store.relater'));
        }
    }


//    CONFLICTS SOLVE

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

    private function stream($payment){
        $user = Auth::user();
        $friendRepository = new FriendRepository();
        $friends = $friendRepository->myFriends();
        foreach($friends as $friend){
            Stream::create([
                'user_id'=>$friend->friend_info->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $payment->id,
                'contentable_type'=> 'App\Payment',
                'parentable_id'=>$user->id,
                'parentable_type'=>'App\User',
                'is_see'=>0
            ]);
        }
        Stream::create([
            'user_id'=>$user->id,
            'edge_ranke'=> 0,
            'contentable_id'=> $payment->id,
            'contentable_type'=> 'App\Payment',
            'parentable_id'=>$user->id,
            'parentable_type'=>'App\User',
            'is_see'=>1
        ]);
    }

}
