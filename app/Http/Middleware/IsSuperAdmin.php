<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class isSuperAdmin
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
        $userId = auth()->user()->id;   //recuperamos por el  id
        $userRoles = User::find($userId)->roles()->get()->toArray();
        dd($userRoles);

        // $userId = auth()->user()->id;
        // $userRoles = User::find($userId)->roles()->select('name')->get()->toArray();
     
        // foreach($userRoles as $userRole) {
        //     if($userRole['name'] === 'super_admin'){
        //         return $next($request);
        //     }
        // }
        // return response()->json('El usuario no tiene el rol super admin', 400);
    }
    
}
