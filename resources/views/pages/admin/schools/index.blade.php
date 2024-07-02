<x-layouts.admin title="School">
    <x-header title="Etablissements" subtitle="Gerer votre établissement">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:schools.create') }}"/>
        </x-slot:actions>
    </x-header>

    <livewire:admin.schools.school-list />
</x-layouts.admin>
