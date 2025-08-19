<x-layouts.super-admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold mb-4">Gestión de Usuarios</h1>

        <x-super-admin.breadcrumb :items="[
            ['label' => 'Dashboard', 'url' => route('super-admin.dashboard')],
            ['label' => 'Usuarios', 'url' => route('super-admin.users.index')],
        ]" />

        <!-- Mensajes de éxito o error -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded shadow transition duration-500">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-4 px-4 py-3 bg-red-100 text-red-800 rounded shadow transition duration-500">
                {{ session('error') }}
            </div>
        @endif

        <!-- Botón Crear Usuario -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('super-admin.users.create') }}"
                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-sonora-naranja hover:bg-orange-600 rounded">
                <x-heroicon-o-plus class="w-5 h-5 mr-2" />
                Crear Usuario
            </a>
        </div>

        <div class="mt-6 bg-white shadow rounded p-6">
            @if ($users->isEmpty())
                <p class="text-gray-600">No hay usuarios registrados creados por ti.</p>
            @else
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nickname</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nombre</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Rol</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Estado</th>
                            <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-600">{{ $user->id }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600">{{ $user->nickname }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600">{{ $user->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-2 text-sm text-gray-600">
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($user->is_active)
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded">Activo</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-right flex justify-end space-x-2">
                                    <!-- Botón Ver -->
                                    <a href="{{ route('super-admin.users.show', $user->id) }}"
                                        class="inline-flex items-center p-2 text-white bg-sonora-naranja hover:bg-orange-600 rounded"
                                        title="Ver">
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                    </a>

                                    <!-- Botón Editar -->
                                    <a href="{{ route('super-admin.users.edit', $user->id) }}"
                                        class="inline-flex items-center p-2 text-white bg-sonora-vino hover:bg-sonora-guinda rounded"
                                        title="Editar">
                                        <x-heroicon-o-pencil-square class="w-5 h-5" />
                                    </a>

                                    <!-- Botón Activar/Desactivar -->
                                    <form action="{{ route('super-admin.users.toggle', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="inline-flex items-center p-2 text-white {{ $user->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-green-500 hover:bg-green-600' }} rounded"
                                            title="{{ $user->is_active ? 'Desactivar' : 'Activar' }}">
                                            @if ($user->is_active)
                                                <x-heroicon-o-lock-closed class="w-5 h-5" />
                                            @else
                                                <x-heroicon-o-lock-open class="w-5 h-5" />
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('super-admin.users.destroy', $user->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center p-2 text-white bg-red-600 hover:bg-red-700 rounded"
                                            title="Eliminar">
                                            <x-heroicon-o-trash class="w-5 h-5" />
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layouts.super-admin>
