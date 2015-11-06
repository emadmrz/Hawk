<?php

namespace App\Repositories;

use App\Group;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupRepository extends Controller
{
    /**
     * Created By Dara on 31/10/2015
     * get all the group users
     */
    public function getAllGroupUsers(Group $group){
        $users=$group->users()->get();
        return $users;
    }

    /**
     * Created By Dara on 31/10/2015
     * check if the current user is member of the group or not
     */
    public function isMember(Group $group){
        $user=Auth::user();
        return $group->users()->where('user_id',$user->id)->exists();
//        if($count){
//            return true;
//        }else{
//            return false;
//        }
    }

    /**
     * Created By Dara on 31/10/2015
     * get the count of the users in the group
     */
    public function userGroupCount(Group $group){
        $count=$group->users()->count();
        return $count;
    }

    /**
     * Created By Dara on 31/10/2015
     * check if the current user is admin or not
     */
    public function isGroupAdmin(Group $group){
        $user=Auth::user();
        if($group->user->id==$user->id){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Created By Dara on 31/10/2015
     * get the last 5 members
     */
    public function getLatestMembers(Group $group){
        $users=$group->users()->latest()->take(5)->get();
        return $users;
    }

    /**
     * Created By Dara on 1/11/2015
     * get all the members except current
     */
    public function getAllJoinUsers($group){
        $user=Auth::user();
        $users=$group->users()->whereNotIn('id',[$user->id])->get();
        return $users;
    }
}
