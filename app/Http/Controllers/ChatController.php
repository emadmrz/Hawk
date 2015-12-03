<?php

namespace App\Http\Controllers;

use App\Events\seenMessage;
use App\Events\sendMessage;
use App\Events\typingMessage;
use App\Message;
use App\MessageUser;
use App\Repositories\ChatRepository;
use App\Repositories\FriendRepository;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Morilog\Jalali\jDate;

class ChatController extends Controller
{
    public function index(FriendRepository $friendRepository, ChatRepository $chatRepository, User $holder){
        $user = Auth::user();
        if(!empty($holder->id)){
            $histories = $chatRepository->historyCollection($holder->id)->get();
            Event::fire(new seenMessage($holder->id));
            MessageUser::where('parentable_type', 'App\User')
                ->where('parentable_id', $holder)
                ->where('user_id', $user->id)
                ->where('status', 0)
                ->update(['status'=>1]);

        }else{
            $histories = [];
        }
        $friends = $friendRepository->myFriends();
        $chats = $chatRepository->myChats();
        $friends = $friends->each(function ($friend, $key) use ($chatRepository) {
            $chatRepository->latest($friend->friend_info->id);
            $friend->latestMessage = $chatRepository->latestMessage();
            $friend->latestCreatedAt = $chatRepository->latestCreatedAt();
            $friend->latestHumanCreatedAt = jDate::forge($friend->latestCreatedAt)->ago();
            $friend->newMessagesCount = $chatRepository->newMessagesCount();
        });
        $friends = $friends->sortByDesc('latestCreatedAt');
        return view('chat.index', compact('user', 'friends', 'chatRepository', 'histories', 'holder', 'chats'))->with(['title'=>'گفتگو']);
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
            'created_at'=>'چند لحظه پیش',
            'status'=>0
        ];
        Event::fire(new sendMessage($data, $holder)); //Broadcast the message data to holder
        return $data;
    }

    public function history(ChatRepository $chatRepository, Request $request){
        $user = Auth::user();
        $holder = $request->input('holder');
        Event::fire(new seenMessage($holder));
        MessageUser::where('parentable_type', 'App\User')
            ->where('parentable_id', $holder)
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->update(['status'=>1]);
        return $chatRepository->historyCollection($holder)->with('message', 'parentable')->get();
    }

    public function typing(Request $request){
        $holder = $request->input('holder');
        Event::fire(new typingMessage($holder));
    }

    public function seen(Request $request){
        $user = Auth::user();
        $holder = $request->input('holder');
        Event::fire(new seenMessage($holder));
        MessageUser::where('parentable_type', 'App\User')
            ->where('parentable_id', $holder)
            ->where('user_id', $user->id)
            ->where('status', 0)
            ->update(['status'=>1]);
    }

    public function latest(ChatRepository $chatRepository){
        $histories = [];
        foreach($chatRepository->myChats() as $message){
            $histories[] = view('chat.partials.message', compact('message'))->render();
        }
        return view('chat.latest',compact('histories'));
    }

}
