<?php

namespace App\Http\Middleware;

use App\Role;
use Closure;

class AdminAccess
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
        $user = $request->user();
        
        if($user) {
            if($user->role_id != Role::ROLE_ADMIN) {
                return response()->json('Unauthorized', 401);
            }
        }
        return $next($request);
    }
}
