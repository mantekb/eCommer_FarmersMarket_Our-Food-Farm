<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class OneStand
{
    /**
     * Don't allow a user to make a stand if they already have one.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest() || Auth::user()->hasStand())
        {
            return Redirect('/');
        }

        return $next($request);
    }
}
