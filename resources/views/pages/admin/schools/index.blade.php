<x-layouts.admin title="Ecoles">
    <x-header title="Ecoles" subtitle="Gerer votre école">
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:schools.create') }}" label="Ajouter école"/>
        </x-slot:actions>
    </x-header>

    <livewire:admin.schools.school-list />
</x-layouts.admin>
