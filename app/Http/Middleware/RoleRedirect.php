<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    public function handle(Request $request, Closure $next)
    {
        // Si el request es hacia /dashboard
        if ($request->is('dashboard')) {

            // Guard WEB
            if (Auth::guard('web')->check()) {
                $user = Auth::guard('web')->user();

                if ($user && $user->hasRole('SuperAdmin')) {
                    return redirect('/super-admin/dashboard');
                }

                if ($user && $user->hasRole('Administrador')) {
                    return redirect('/admin/dashboard');
                }
            }

            // Guard EXAM
            if (Auth::guard('exam')->check()) {
                $examUser = Auth::guard('exam')->user();

                if ($examUser && $examUser->hasRole('Usuario')) {
                    return redirect('/user/dashboard');
                }
            }
        }

        return $next($request);
    }
}
