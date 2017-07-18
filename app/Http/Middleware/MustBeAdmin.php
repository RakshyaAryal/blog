<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class MustBeAdmin
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
        $loggedInUser= Auth::user();
           if(1 != $loggedInUser->user_type){
           abort(403, 'Permission denied');
      }

        return $next($request);
    }
}
