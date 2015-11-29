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
        'App\Events\offerPurchased' => [
            'App\Listeners\updateOffer'
        ],
        'App\Events\couponPurchased' => [
            'App\Listeners\updateCoupon'
        ],
        'App\Events\shopPurchased' => [
            'App\Listeners\activeShop',
        ],
        'App\Events\advertisePurchased' => [
            'App\Listeners\activeAdvertise',
        ],
        'App\Events\sendMessage'=>[],
        'App\Events\relaterPurchased' => [
            'App\Listeners\relateProfile',
        ],
        'App\Events\profitPurchased' => [
            'App\Listeners\profitSearch',
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
