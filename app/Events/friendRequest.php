<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Auth;

class friendRequest extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $holder;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($holder, $status, $friend)
    {
        $this->holder = $holder;
        $user = Auth::user();
        if($status == 0){
            $message = 'درخواست دوستی برای شما ارسال کرد.';
            $this->notification = $this->friendRequest($user, $message);
        }elseif($status == 1){
            $message = 'درخواست دوستی شما را تایید کرد.';
            $this->notification = $this->friendRequest($user, $message);
        }elseif($status == 2){
            $message = 'درخواست دوستی شما را رد کرد.';
            $this->notification = $this->friendRequest($user, $message);
        }
    }

    private function friendRequest(User $user, $message){
        return view('notifications.friendRequest', compact('user', 'message'))->render();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['user.'.$this->holder];
    }
}
