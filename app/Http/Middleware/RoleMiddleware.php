<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $roles)
{
    $rolesArray = explode(',', $roles);

    // Debugging
    if (!Auth::check()) {
        abort(403, 'User not authenticated');
    }

    if (!in_array(Auth::user()->role, $rolesArray)) {
        abort(403, 'Role not matched');
    }

    return $next($request);
}
}
