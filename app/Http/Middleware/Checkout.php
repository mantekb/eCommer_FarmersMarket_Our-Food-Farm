<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Checkout
{
    /**
     * Don't allow a user to go to checkout if they aren't logged in or don't have a cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return Redirect('/checkout/error/login');
        }

        if (!Session::has('cart'))
        {
            return Redirect('/checkout/error/cart');
        }

        return $next($request);
    }
}
