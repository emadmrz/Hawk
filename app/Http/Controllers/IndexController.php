<?php

namespace App\Http\Controllers;

use App\Advertise;
use App\Opening;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class IndexController extends Controller
{
    public function index(){

        $advertises = Advertise::where('expired_at', '>=', Carbon::now())->where('expired_at', '<=', Carbon::now()->addDays(1))->active()->groupBy('user_id')->get();
        $advertises_list = Advertise::where('expired_at', '>=', Carbon::now())->where('expired_at', '<=', Carbon::now()->addDays(1))->active()->groupBy('user_id')->get();
        $result = [];
        while(count($advertises) > 0){
            $gold = 0;
            $silver = 0;
            $bronze = 0;
            $cumulative = [];
            $cumulant = 0;

            foreach($advertises as $advertise){
                if($advertise->type == 1){
                    $gold++;
                }elseif($advertise->type == 2){
                    $silver++;
                }elseif($advertise->type == 3){
                    $bronze++;
                }
            }

            foreach($advertises as $key=>$advertise){
                if($advertise->type == 1){
                    $coff = 4;
                }elseif($advertise->type == 2){
                    $coff = 2;
                }elseif($advertise->type == 3){
                    $coff = 1;
                }
                $probability = ($coff)/(4*$gold+2*$silver+$bronze);
                $advertise->probability = $probability;
                $cumulant += $probability;
                $cumulative[] = ['user_id'=> $advertise->user_id, 'cumulant'=>$cumulant];
            }

            $rand = rand(0,10000)/10000;
            $cumulative[-1] = 0;
            for($i=0; $i<count($cumulative) ; $i++){
                if($rand > $cumulative[$i-1]['cumulant'] and $rand <= $cumulative[$i]['cumulant']){
                    $result [] = ['user_id'=>$cumulative[$i]['user_id']];
                    $user_id = $cumulative[$i]['user_id'];
                    $advertise_id =  $advertises->search(function ($item, $key) use($user_id) {
                        return $item->user_id = $user_id;
                    });
                    $advertises->forget($advertise_id);
                    break;
                }
            }

        }

        $sorted_advertises = new \Illuminate\Database\Eloquent\Collection;
        foreach($result as $item){
            $sorted_advertises ->add($advertises_list->where('user_id',$item['user_id'])->first());
        }

//        dd($sorted_advertises);




//        $users = [];
//        $users [] = ['id'=>1, 'name'=>'emad', 'type'=>1];
//        $users [] = ['id'=>2, 'name'=>'jafar', 'type'=>3];
//        $users [] = ['id'=>3, 'name'=>'ekarim', 'type'=>3];
//        $users [] = ['id'=>4, 'name'=>'ahmad', 'type'=>2];
//        $users [] = ['id'=>5, 'name'=>'gholam', 'type'=>2];
//        $users [] = ['id'=>6, 'name'=>'kazem', 'type'=>3];
//        $users [] = ['id'=>7, 'name'=>'saeed', 'type'=>3];
//        $users [] = ['id'=>8, 'name'=>'sepehr', 'type'=>3];
//        $users [] = ['id'=>9, 'name'=>'karamali', 'type'=>2];
//        $users [] = ['id'=>10, 'name'=>'abas', 'type'=>3];
//        $users [] = ['id'=>11, 'name'=>'kambiz', 'type'=>2];
//        $users [] = ['id'=>12, 'name'=>'asghar', 'type'=>1];
//        $users [] = ['id'=>13, 'name'=>'homayoon', 'type'=>3];
//        $users [] = ['id'=>14, 'name'=>'iraj', 'type'=>2];
//        $users [] = ['id'=>15, 'name'=>'mojtaba', 'type'=>3];
//        $users [] = ['id'=>16, 'name'=>'javid', 'type'=>1];
//
//
//        $result=[];
//
//        while(count($users) > 0){
//
//            $gold = 0;
//            $silver = 0;
//            $bronze = 0;
//            $cumulative = [];
//            $cumulant = 0;
//
//            foreach($users as $user){
//                if($user['type'] == 1){
//                    $gold++;
//                }elseif($user['type'] == 2){
//                    $silver++;
//                }elseif($user['type'] == 3){
//                    $bronze++;
//                }
//            }
//
//            foreach($users as $key=>$user){
//                if($user['type'] == 1){
//                    $coff = 4;
//                }elseif($user['type'] == 2){
//                    $coff = 2;
//                }elseif($user['type'] == 3){
//                    $coff = 1;
//                }
//                $probability = ($coff)/(4*$gold+2*$silver+$bronze);
//                $users[$key]['probability'] = $probability;
//                $cumulant+=$probability;
//                $cumulative[] = ['user_id'=> $user['id'], 'cumulant'=>$cumulant];
//            }
//
//            $rand = rand(0,1000)/1000;
//            $cumulative[-1] = 0;
//            for($i=0; $i<count($cumulative) ; $i++){
//                if($rand > $cumulative[$i-1]['cumulant'] and $rand <= $cumulative[$i]['cumulant']){
//                    $result [] = [$cumulative[$i]['user_id']];
//                    array_forget($users, $i);
//                    $users = array_values($users);
//                    break;
//                }
//            }
//
//        }
//
//        dd([$result, $users]);


        return view('index.index', compact('sorted_advertises'));
    }

    public function old(){
        //        $fruits = array('apple' => '100', 'orange' => '50', 'pear' => '10');

//        $newFruits = [];
//        foreach ($advertises as $key=>$value)
//        {
//            if($value->type == 1){
//                $multi = 24;
//            }elseif($value->type == 2){
//                $multi = 12;
//            }elseif($value->type == 3){
//                $multi = 6;
//            }
//            $newFruits = array_merge($newFruits, array_fill(0, $multi, $value->user_id));
//        }
//        $results=[];
//        while(count($results) != count($advertises)){
//            $random_value = $newFruits[array_rand($newFruits)];
//            if(!in_array($random_value, $results)){
//                $results[] = $random_value;
//            }
//        }
//        dd($results);
//        $output = [];
//        foreach($results as $result){
//            $output[] = $advertises->where('user_id', $result)->first();
//        }
//        dd($output);
    }

    public function invitation(){
        return view('invitation.index');
    }

    public function invitationRegister(Request $request){
        $this->validate($request, [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required|unique:openings|max:100',
        ]);
        Opening::create($request->all());
        Flash::success('از عضویت شما در خبرنامه Skillema سپاسگزاریم. ما شما را از آخرین رویدادهای Skillema با خبر می کنیم.');
        return redirect()->back();
    }

}
