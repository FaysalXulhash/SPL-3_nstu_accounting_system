<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $except = null, ...$roles)
    {
        $role_code = $request->user()->role->code;

        if (($except == 'except' && in_array($role_code, $roles)) || (!$except && !in_array($role_code, $roles))) {
            abort(403);
        }

        return $next($request);
    }
}
