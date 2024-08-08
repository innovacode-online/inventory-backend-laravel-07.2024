<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AdminValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        if( !$user->role_id )
        {
            return response()->json([
                "message" => "El usuario no tiene un rol asignado"
            ],401);
        }

        $role = DB::table('roles')->find($user->role_id);

        if( $role->name === "Admin" ){
            return $next($request);
        }

        return response()->json([
            "message" => "No esta permitido realizar esta acción"
        ],401);

    }
}
