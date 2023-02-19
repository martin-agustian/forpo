<?php

namespace App\Http\Middleware;

use Closure;

class DashboardGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (request()->session()->has('siswa')) {
            return $next($request);
        }
        else {
            return redirect('/login');
        }
    }
}