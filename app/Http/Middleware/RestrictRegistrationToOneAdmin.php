<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RestrictRegistrationToOneAdmin
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = DB::table('users')->select('role')->where('id',1)->first();
        if ($user && (int)$user->role === 1){
            // redirect to home, if we have user with this role
            return redirect("/");
        }
        return $next($request);
    }
}
