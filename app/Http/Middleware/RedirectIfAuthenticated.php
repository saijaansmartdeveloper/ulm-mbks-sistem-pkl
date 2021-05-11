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
                // return redirect(RouteServiceProvider::HOME);
                switch ($guard) {
                    case 'lecturer':
                        return redirect()->route('public.lecturer.index');
                    case 'student':
                        return redirect()->route('public.student.index');
                    default:
                        if (Auth::User()->hasRole('super_admin')) {
                            return redirect()->route('super_admin.dashboard');
                        } else if (Auth::User()->hasRole('admin_prodi')) {
                            return redirect()->route('admin_prodi.dashboard');
                        } else if (Auth::User()->hasRole('supervisor')) {
                            // return redirect()->route('supervisor.dashboard');
                        } else {
                            return redirect(RouteServiceProvider::HOME);
                        }
                }
            }
        }

        return $next($request);
    }
}
