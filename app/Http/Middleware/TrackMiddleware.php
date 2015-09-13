<?php

namespace App\Http\Middleware;

use App\Repositories\TrackController;
use Closure;

class TrackMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    private $track;

    public function __construct(TrackController $track)
    {
        $this->track = $track;
    }
    /*
     * Created By Dara on 13/9/2015
     * handling the visitor section
     */
    public function handle($request, Closure $next)
    {

        if (!$this->track->checkIpExists()) { //check if the IP exists in the session
            $this->track->getUserInfo(); //browser,position
            $this->track->updateSession();
            $this->track->insertDb(); // insert new row in database
        } elseif ($this->track->getTimeDifference() >= 3600) {
            $this->track->getUserInfo();
            $this->track->updateSession(); // update time,position,ip
            $this->track->insertDb();
        } elseif ($this->track->getTimeDifference() < 3600) {
            $this->track->getUserInfo();
            if (!$this->track->checkUserPositionExists()) { //check if the position "user" exists in the session
                if ($this->track->position == "user") {
                    $this->track->updateSession();
                    $this->track->insertDb();
                }
            }

            $this->track->updateSession();
        }
        return $next($request);
    }
}
