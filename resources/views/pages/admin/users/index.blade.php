<x-layouts.admin title="User Liste">
    <x-header title="Users" subtitle="Manage users">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" />
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:users.create') }}"/>
        </x-slot:actions>
    </x-header>

    <livewire:admin.users.user-list />
</x-layouts.admin>
