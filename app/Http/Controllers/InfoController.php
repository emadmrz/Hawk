<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function edit(Request $request){
        $user = Auth::user();
        $account=$request->only('user');
        $info = $request->except('user', 'other_address', 'email','_token');
        $user->update($account['user']);
        $user->info()->update($info);
        if($request->has('other_address') and $user->is('legal') ){
            $addresses = $request->input('other_address');
            $address_ids = [];
            foreach($addresses as $address){
                if(!empty($address)){
                    $item = $user->addresses()->create(['address'=>$address]);
                    $address_ids[] = $item->id;
                }
            }
            Address::where('user_id', $user->id)->whereNotIn('id', $address_ids)->delete();
        }
        $input=$request->all();
        $input['city']=$user->info->city;
        $input['province']=$user->info->province;
        return [
            'hasCallback'=>'1',
            'callback'=>'user_info',
            'hasMsg'=>'1',
            'msg'=>'data inserted successfully',
            'returns'=>$input
        ];
    }
}
