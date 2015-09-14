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
        $this->browser = $userInfo['name'] . " " . $userInfo['version'] . " " . $userInfo['platform'];
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
        $useragent = $this->request->header('user-agent');
        $u_agent = $useragent;
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version = "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        } elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
            if (preg_match('/NT 6.2/i', $u_agent)) {
                $platform .= ' 8';
            } elseif (preg_match('/NT 6.3/i', $u_agent)) {
                $platform .= ' 8.1';
            } elseif (preg_match('/NT 6.1/i', $u_agent)) {
                $platform .= ' 7';
            } elseif (preg_match('/NT 6.0/i', $u_agent)) {
                $platform .= ' Vista';
            } elseif (preg_match('/NT 5.1/i', $u_agent)) {
                $platform .= ' XP';
            } elseif (preg_match('/NT 5.0/i', $u_agent)) {
                $platform .= ' 2000';
            }
            if (preg_match('/WOW64/i', $u_agent) || preg_match('/x64/i', $u_agent)) {
                $platform .= ' (x64)';
            }
        }

        // Next get the name of the useragent yes seperately and for good reason
        if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $u_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $u_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $u_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $u_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $u_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }elseif (preg_match('/Trident/i', $u_agent)){
            $bname = 'Internet Explorer';
            $ub="";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
                $version = $matches['version'][0];
            } else {
                $version = $matches['version'][1];
            }
        } else {
            $version = $matches['version'][0];
        }

        // check if we have a number
        if ($version == null || $version == "") {
            $version = "?";
        }
        $data = array(
            'name' => $bname,
            'version' => $version,
            'platform' => $platform
        );

        return $data;

    }


}