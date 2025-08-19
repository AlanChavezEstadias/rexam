<x-layouts.super-admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold mb-4">Detalle de Usuario</h1>

        <x-super-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('super-admin.dashboard')],
            ['label' => 'Usuarios', 'url' => route('super-admin.users.index')],
            ['label' => 'Detalle', 'url' => route('super-admin.users.show', $user->id)],
        ]" />

        <div class="mt-6 bg-white shadow rounded p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">ID</dt>
                    <dd class="mt-1 text-gray-900">{{ $user->id }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Nickname</dt>
                    <dd class="mt-1 text-gray-900">{{ $user->nickname }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                    <dd class="mt-1 text-gray-900">{{ $user->name }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-gray-900">{{ $user->email }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Rol</dt>
                    <dd class="mt-1 text-gray-900">
                        {{ $user->roles->pluck('name')->join(', ') }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Estado</dt>
                    <dd class="mt-1">
                        @if ($user->is_active)
                            <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">
                                Activo
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded">
                                Inactivo
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>

            <div class="mt-6 flex justify-end space-x-2">
                <a href="{{ route('super-admin.users.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">
                    Volver
                </a>
                <a href="{{ route('super-admin.users.edit', $user->id) }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-sonora-vino hover:bg-sonora-guinda rounded">
                    Editar
                </a>
            </div>
        </div>
    </div>
</x-layouts.super-admin>
