<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\UserRegistered' => [
            'App\Listeners\InitiateUser',
        ],
        'App\Events\storagePurchased' => [
            'App\Listeners\increaseCapacity',
        ],
        'App\Events\pollPurchased' => [
            'App\Listeners\activePoll',
        ],
        'App\Events\questionnairePurchased' => [
            'App\Listeners\activeQuestionnaire',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
