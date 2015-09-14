<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;


class TrackController extends Controller
{
    private $request;
    public $ip;
    public $position;
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
        $userInfo = $this->getBrowser();
        $this->browser = $userInfo['name'] . " " . $userInfo['version'] . " " . $userInfo['platform']. " " . $userInfo['platformVersion'] . " " . $userInfo['device'];
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

    public function checkUserPositionExists()
    {
        if (session('position') == "user") {
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
    public function updateSession()
    {
        session(['visitor_id' => $this->ip,'position'=>$this->position, 'time' => time()]);
    }

    /*
    * Created By Dara on 11/9/2015
    * return time passed till last refresh
    */
    public function getTimeDifference()
    {
        return time() - session('time');
    }

    /*
    * Created By Dara on 13/9/2015
    * translate the user-agent
    */
    private function getBrowser()
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $platform = $agent->platform();
        $data = array(
            'name' => $browser,
            'version' => $agent->version($browser),
            'platform' => $platform,
            'platformVersion' => $agent->version($platform),
            'device' => $agent->device()
        );



        return $data;

    }


}