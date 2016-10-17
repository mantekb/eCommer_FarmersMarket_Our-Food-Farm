<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class HasStand
{
    /**
     * Only allow a user to do stand functions if they have one.
     * This is an altered version of OneStand
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            return redirect()->guest('login');
        }

        if (!Auth::user()->hasStand())
        {
            return Redirect('/stand/create');
        }

        return $next($request);
    }
}
