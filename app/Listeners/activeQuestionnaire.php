<?php

namespace App\Listeners;

use App\Addon;
use App\Events\questionnairePurchased;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class activeQuestionnaire
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
     * @param  questionnairePurchased  $event
     * @return void
     */
    public function handle(questionnairePurchased $event)
    {
        $payment = $event->payment;
        $questionnaire = $payment->itemable;
        $payment->update(['status'=>1]);
        $questionnaire->update(['status'=>1]);
        Addon::questionnaire()->first()->buy();
    }
}
