<x-layouts.admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold">Panel de Administrador</h1>
        <x-admin.breadcrumb :items="[['label' => 'Dashboard', 'url' => route('admin.dashboard')]]" />
    </div>
</x-layouts.admin>
