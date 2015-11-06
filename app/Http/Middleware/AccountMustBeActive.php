<?php

namespace NpTS\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Jenssegers\Agent\Agent;

class AccountMustBeActive
{
    private $guard;
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $this->guard->user()->active)
        {
            return response()->view('errors.notActiveAccount', ['auth' => $this->guard , 'agent' => app()->make(Agent::class)]);
        }
        return $next($request);
    }
}
