<?php

namespace App\Events;

use App\Events\Event;
use App\Repositories\NotificationRepository;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Notification extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public  $holder;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($holder, $type, $item)
    {
        $this->holder = $holder;
        $notificationRepository = new NotificationRepository();
        if($type == 'App\Article'){
            $this->notification = $notificationRepository->article($item);
        }elseif($type == 'App\Post'){
            $this->notification = $notificationRepository->post($item);
        }
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
