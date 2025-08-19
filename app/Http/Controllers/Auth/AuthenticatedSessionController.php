<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('SuperAdmin')) {
            return redirect()->route('super-admin.dashboard');
        }

        if ($user->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Usuario')) {
            return redirect()->route('user.dashboard');
        }

        // fallback si no tiene rol asignado
        return redirect()->route('login');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
