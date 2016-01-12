<?php

namespace App\Listeners;

use App\Addon;
use App\Events\recruitmentConfirmed;
use App\Events\recruitmentPurchased;
use App\Stream;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class publishRecruitment
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
     */
    public function handle(recruitmentConfirmed $event)
    {

        $recruitment=$event->recruitment;
        $id=$recruitment->user_id;
        $query='SELECT users.*';
        $query=$query.' FROM `users` INNER JOIN `skills` ON `skills`.`user_id`=`users`.`id`';
        $query=$query.' INNER JOIN `categories` ON `categories`.`id`=`skills`.`sub_category_id`';
        $query=$query.' INNER JOIN `tags` ON `tags`.`parent_id`=`categories`.`id`';
        $query=$query.' INNER JOIN `recruitment_tag` ON `recruitment_tag`.`tag_id`=`tags`.`id`';
        $query=$query." WHERE `users`.`id` != '".$id."'";
        $query=$query.' GROUP BY `users`.`id`';
        $results=DB::select($query);

        //transform the results into User object
        $users=[];
        foreach($results as $key=>$result){
            $users[$key]=new User();
            $users[$key]->id=$result->id;
            $users[$key]->first_name=$result->first_name;
            $users[$key]->last_name=$result->last_name;
            $users[$key]->email=$result->email;
            $users[$key]->password=$result->password;
            $users[$key]->image=$result->image;
            $users[$key]->cover=$result->cover;
            $users[$key]->description=$result->description;
            $users[$key]->confirmed=$result->confirmed;
            $users[$key]->status=$result->status;
            $users[$key]->rate=$result->rate;
            $users[$key]->created_at=$result->created_at;
            $users[$key]->updated_at=$result->updated_at;
        }
        foreach($users as $user){
            Stream::create([
                'user_id'=>$user->id,
                'edge_ranke'=> 0,
                'contentable_id'=> $recruitment->id,
                'contentable_type'=> 'App\Recruitment',
                'parentable_id'=>$recruitment->user->id,
                'parentable_type'=>'App\User',
                'is_see'=>1
            ]);
        }

    }
}
