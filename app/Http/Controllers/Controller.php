<?php

namespace NpTS\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Auth\Guard;
use Agent;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(Guard $auth , Agent $agent)
    {
        view()->share([
            'auth'      =>  $auth,
            'agent'     =>  $agent,
        ]);
    }
}
