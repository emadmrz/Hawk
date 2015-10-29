<?php

namespace App\Http\Controllers;

use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StreamController extends Controller
{
    public function notification(NotificationRepository $notificationRepository){
        $notifications = $notificationRepository->notifications();
        return view('notifications.notifications', compact('notifications'));
    }
}
