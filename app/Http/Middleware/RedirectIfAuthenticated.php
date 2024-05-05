<?php

namespace App\Http\Middleware;

use App\Http\Constants\AuthConstans;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case AuthConstans::GUARD_USER:
                if (Auth::guard($guard)->check()) {
                    return redirect()->intended(route('user.doctor.specialization.index'));
                }
                break;
            case AuthConstans::GUARD_ADMIN:
                if (Auth::guard($guard)->check()) {
                    return redirect()->intended(route('admin.admin-dashboard'));
                }
                break;

            default:
                if (! is_null($guard) && Auth::guard($guard)->check()) {
                    return redirect()->intended(route('home'));
                }
                break;
        }

        return $next($request);
    }

}
