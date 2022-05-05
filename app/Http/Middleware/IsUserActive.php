<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUserActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        $isUserActive = auth()->user()->is_active;

        if($isUserActive)
        {
            return $next($request);
        }
        return response()->json('el usuario no ha activado la cuenta', 400);

        // if($request->is_admin === 'true')
        // {
        // return $next($request);
        // }
        // return response()->json('No estás autorizado', 401);
    }
    //     return $next($request);
    // }
}
