<?php

namespace NpTS\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Guard;
use Jenssegers\Agent\Agent;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $auth = app()->make(Guard::class);
        $agent = app()->make(Agent::class);
        view()->share([
            'auth'      =>  $auth,
            'agent'     =>  $agent,
        ]);
    }
}
