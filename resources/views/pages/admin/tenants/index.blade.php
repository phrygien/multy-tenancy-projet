<x-layouts.admin title="Tenants">
    <x-header title="Tenants" subtitle="Manage tenant">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:tenants.create') }}"/>
        </x-slot:actions>
    </x-header>

    <livewire:admin.tenants.tenant-list />
</x-layouts.admin>
