<?php
namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = Auth::user()->createdUsers()->with('roles')->get();
        return view('super-admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('super-admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('super-admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50',
            'name'     => 'required|string|max:100|regex:/^[A-ZÁÉÍÓÚÑ\s]+$/u',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'nickname'   => $validated['nickname'],
            'name'       => strtoupper($validated['name']),
            'email'      => strtolower($validated['email']),
            'password'   => bcrypt($validated['password']),
            'created_by' => auth()->id(),
        ]);

        // Asignar rol Administrador
        $user->assignRole('Administrador');

        return redirect()->route('super-admin.users.index')->with('success', 'Usuario creado correctamente');
    }

    public function edit(User $user)
    {
        return view('super-admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50',
            'name'     => 'required|string|max:100|regex:/^[A-ZÁÉÍÓÚÑ\s]+$/u',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
        ]);

        $user->nickname = $validated['nickname'];
        $user->name     = strtoupper($validated['name']);
        $user->email    = strtolower($validated['email']);

        if (! empty($validated['password'])) {
            $user->password = bcrypt($validated['password']);
        }

        $user->save();

        return redirect()->route('super-admin.users.index')
            ->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('super-admin.users.index')
            ->with('success', 'Usuario eliminado correctamente');
    }

    public function toggleStatus(User $user)
    {
        // Cambiar el estado
        $user->is_active = ! $user->is_active;
        $user->save();

        return redirect()->route('super-admin.users.index')->with('success', 'El estado del usuario ha sido actualizado correctamente.');
    }
}
