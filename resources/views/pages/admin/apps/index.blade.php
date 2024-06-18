<x-layouts.admin title="Application">
    <x-header title="Apps" subtitle="Manage applications">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:tenants.create') }}"/>
        </x-slot:actions>
    </x-header>

 <livewire:admin.apps.apps-list />
</x-layouts.admin>
