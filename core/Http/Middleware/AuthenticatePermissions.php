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
        if ($request->user()->cannot($this->permission($request->route()->getName()))) {
            return abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

    /**
     * Parse the permission code and remove
     * api prefixes if any.
     *
     * @param  string $route
     * @return string
     */
    protected function permission($route): string
    {
        return str_replace('api.', '', $route);
    }
}
