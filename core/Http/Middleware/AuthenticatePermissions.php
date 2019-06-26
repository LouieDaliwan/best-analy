<?php

namespace Core\Http\Middleware;

use Closure;

class AuthenticatePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->cannot($request->route()->getName())) {
            return abort(403);
        }

        return $next($request);
    }
}
