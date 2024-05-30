<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $request->user();

        if ($user->roles->contains('role', $role)) {
            return $next($request);
        }

        return response()->json(['error' => 'Forbidden'], 403);
    }
}
