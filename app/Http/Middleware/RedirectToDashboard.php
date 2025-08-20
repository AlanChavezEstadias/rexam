<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectToDashboard
{
    public function handle(Request $request, Closure $next): Response
    {
        // Guard WEB
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            if ($user && $user->hasRole('SuperAdmin')) {
                return redirect()->route('super-admin.dashboard');
            }

            if ($user && $user->hasRole('Administrador')) {
                return redirect()->route('admin.dashboard');
            }
        }

        // Guard EXAM
        if (Auth::guard('exam')->check()) {
            $examUser = Auth::guard('exam')->user();

            if ($examUser && $examUser->hasRole('Usuario')) {
                return redirect()->route('user.dashboard');
            }
        }

        // Si no está logueado en ningún guard
        return redirect()->route('login');
    }
}
