<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class InitiateUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $newUser = $event->user;
        $newUser->info()->create(['user_id'=>$newUser->id]);
        $newUser->usage()->create(['user_id'=>$newUser->id, 'capacity'=>300]);
        $newUser->activity()->create(['user_id'=>$newUser->id, 'status'=>1, 'online'=>1]);
        File::makeDirectory(public_path().'/img/files/'.$newUser->id, 0775, true, true);
//        Mail::send('emails.welcome', ['user'=>$newUser], function ($message)use ($newUser)  {
//            $message->to($newUser['email'])->subject('welcome to skillema');
//        });
    }
}
