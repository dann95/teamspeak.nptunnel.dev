<?php

namespace NpTS\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Jenssegers\Agent\Agent;

class AccountMustBeNotBanned
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
        if($this->guard->user()->banned)
        {
            return response()->view('errors.bannedAccount',['auth' => $this->guard , 'agent' => app(Agent::class)]);
        }
        return $next($request);
    }
}
