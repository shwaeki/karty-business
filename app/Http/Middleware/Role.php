<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    public function handle($request, Closure $next, ...$roles)
    {


        $user = auth('admin')->user();

        if ($user->isAdmin())
            return $next($request);

        foreach ($roles as $role) {
            if ($user->type == $role)
                return $next($request);
        }
        return abort(403, 'Unauthorized action.');
    }

}
