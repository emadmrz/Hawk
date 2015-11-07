<?php

namespace App\Providers;

use App\Http\Controllers\EventController;
use App\Http\Controllers\SettleController;
use App\Repositories\GroupRepository;
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

        /**
         * Created By Dara on 3/11/2015
         * authorize for confirm answer to the question
         */
        $gate->define('confirm-problem-answer',function($user,$problem){
            return $user->id===$problem->user_id;
        });

        /**
         * Created By Dara on 4/11/2015
         * authorize for adding problem to the group
         */
        $gate->define('join-group',function($user,$group){
            $groupRepository=new GroupRepository();
            return !$groupRepository->isMember($group);

        });

        $gate->define('delete-problem-comment', function ($user, $problem, $comment) {
            return ($user->id === $problem->user_id or $user->id === $comment->user_id) ;
        });

        $gate->define('update-problem-comment', function ($user, $comment) {
            return $user->id === $comment->user_id ;
        });

        $gate->define('delete-group', function ($user, $group) {
            return $user->id === $group->user_id ;
        });

        /**
         * Created By Dara on 5/11/2015
         * offer authorize managing
         */
        $gate->define('edit-offer',function($user,$offer){
            return $user->id===$offer->user_id;
        });

        /**
         * Created By Dara on 7/11/2015
         * check if the user can settle or not
         */
        $gate->define('can-settle',function(){
            $settle=new EventController();
            $set=$settle->settleTime();
            return $set['canSettle'];
        });
    }
}