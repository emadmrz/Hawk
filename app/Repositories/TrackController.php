<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;


class TrackController extends Controller
{
    private $request;
    public $ip;
    private $position;
    private $browser;
    private $session;

    public function __construct(Request $request, Store $store)
    {
        $this->session = $store;
        $this->request = $request;
        $this->ip = $request->getClientIp();

    }

    /*
     * Created By Dara on 11/9/2015
     * get user info rather than ip address
     */
    public function getUserInfo()
    {
        $this->browser = $this->request->header('user-agent');
        if (Auth::check()) {
            $this->position = "user";
        } else {
            $this->position = "guest";
        }
    }

    /*
    * Created By Dara on 11/9/2015
    * check if the ip of visitor exists in the session
    */
    public function checkIpExists()
    {
        if (session('visitor_id') == $this->ip) {
            return true;
        } else {
            return false;
        }
    }
    /*
    * Created By Dara on 11/9/2015
    * insert new record in database
    */
    public function insertDb()
    {
        $visitor = new Visitor;
        $visitor->ip = $this->ip;
        $visitor->browser = $this->browser;
        $visitor->position = $this->position;
        $visitor->save();
    }
    /*
    * Created By Dara on 11/9/2015
    * update session for visitors
    */
    public function updateSession(){
        session(['visitor_id' => $this->ip, 'time' => time()]);
    }
    /*
    * Created By Dara on 11/9/2015
    * return time passed till last refresh
    */
    public function getTimeDifference(){
        return time()-session('time');
    }


}