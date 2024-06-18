<x-layouts.admin title="Modules Application">
    <x-header title="Modules Apps" subtitle="Manage modules application">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:tenants.create') }}"/>
        </x-slot:actions>
    </x-header>

 <livewire:admin.modules.module-list />
</x-layouts.admin>
