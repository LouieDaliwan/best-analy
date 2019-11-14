<?php

namespace Core\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

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
        if ($request->user()->isNotSuperAdmin() && $request->user()->cannot($key = $request->route()->getName())) {
            return abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
