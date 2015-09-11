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
    public function __construct(TrackController $track){
        $this->track=$track;
    }
    public function handle($request, Closure $next)
    {
        if (!$this->track->checkIpExists()) {
            $this->track->getUserInfo();
            $this->track->updateSession();
            $this->track->insertDb();
        } elseif ($this->track->getTimeDifference() >= 3600) {
            $this->track->getUserInfo();
            $this->track->updateSession();
            $this->track->insertDb();
        } elseif ($this->track->getTimeDifference() < 3600) {
            $this->track->updateSession();
        }
        return $next($request);
    }
}
