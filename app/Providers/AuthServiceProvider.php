<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);

        $gate->define('delete-post-comment', function ($user, $post, $comment) {
            return ($user->id === $post->user_id or $user->id === $comment->user_id) ;
        });

        $gate->define('update-post-comment', function ($user, $comment) {
            return $user->id === $comment->user_id ;
        });

        $gate->define('export-questionnaire', function ($user, $questionnaire) {
            return $user->id === $questionnaire->user_id ;
        });


        //
    }
}