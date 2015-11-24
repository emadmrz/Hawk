<?php

namespace App\Http\Controllers;

use App\Events\sendMessage;
use App\Events\typingMessage;
use App\Message;
use App\Repositories\ChatRepository;
use App\Repositories\FriendRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class ChatController extends Controller
{
    public function index(FriendRepository $friendRepository, ChatRepository $chatRepository, User $holder){
        $user = Auth::user();
        if(!empty($holder->id)){
            $histories = $chatRepository->historyCollection($holder->id)->get();
        }else{
            $histories = [];
        }
        $friends = $friendRepository->myFriends()->all();
        return view('chat.index', compact('user', 'friends', 'chatRepository', 'histories', 'holder'))->with(['title'=>'گفتگو']);
    }

    public function send(Request $request, User $user){
        $text = $request->input('message');
        $holder = $request->input('holder');
        $message = Message::create(['message'=>$text]);
        $user->message()->create(['user_id'=>$user->id, 'message_id'=>$message->id, 'status'=>1]);
        $user->message()->create(['user_id'=>$holder, 'message_id'=>$message->id, 'status'=>0]);
        $data = [
            'message'=>$text,
            'message_id'=>$message->id,
            'user_id'=>$user->id,
            'username'=>$user->username,
            'avatar'=>$user->avatar,
            'created_at'=>$message->shamsi_created_at
        ];
        Event::fire(new sendMessage($data, $holder)); //Broadcast the message data to holder
        return $data;
    }

    public function history(ChatRepository $chatRepository, Request $request){
        $holder = $request->input('holder');
        return $chatRepository->historyCollection($holder)->with('message', 'parentable')->get();
    }

    public function typing(Request $request){
        $holder = $request->input('holder');
        Event::fire(new typingMessage($holder));
    }
}
