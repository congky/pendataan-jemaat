<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginUser
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

        if(!Session::has("HAS_SESSION")) {
            return redirect("/")->with("message", "Silahkan untuk login dahulu");
        }

        return $next($request);
    }
}
