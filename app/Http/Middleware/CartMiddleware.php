<?php

namespace NpTS\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use NpTS\Domain\Client\Cart\Contract\CartContract;

class CartMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! Session::has('cart'))
        {
            Session::put('cart', app(CartContract::class));
        }
        return $next($request);
    }
}
