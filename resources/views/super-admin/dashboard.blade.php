<x-layouts.super-admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold mb-4">Bienvenido al Dashboard del SuperAdmin</h1>
        <x-super-admin.breadcrumb :items="[['label' => 'Dashboard', 'url' => route('super-admin.dashboard')]]" />
    </div>
</x-layouts.super-admin>
