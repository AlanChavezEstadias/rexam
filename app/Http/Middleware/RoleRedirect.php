<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirect
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Si el usuario no está logueado, lo dejamos pasar a login
        if (! $user) {
            return $next($request);
        }

        // Si viene a /dashboard, lo redirigimos según rol
        if ($request->is('dashboard')) {
            if ($user->hasRole('SuperAdmin')) {
                return redirect('/dashboard/superadmin');
            }

            if ($user->hasRole('Administrador')) {
                return redirect('/dashboard/admin');
            }

            return redirect('/dashboard/user');
        }

        return $next($request);
    }
}
