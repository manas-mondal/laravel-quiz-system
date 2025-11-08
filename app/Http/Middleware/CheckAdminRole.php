<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin= Session::get('admin');

        if(!$admin || $admin->role!=='admin'){
            return redirect()
                    ->back()
                    ->with('error',"Permission denied! Admin access required.");
        }
        return $next($request);
    }
}
