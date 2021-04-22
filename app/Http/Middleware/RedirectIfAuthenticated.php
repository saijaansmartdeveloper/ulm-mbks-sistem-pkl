<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'lecturer' :
                        $redirectTo = 'public/lecturer/dosen';
                        break;
                    case 'student' :
                        $redirectTo = 'public/student/dosen';
                        break;
                    case 'partner' :
                        $redirectTo = 'public/partner/dosen';
                        break;
                    default :
                        $redirectTo = RouteServiceProvider::HOME;
                }
                return $redirectTo;
            }
        }

        return $next($request);
    }
}
