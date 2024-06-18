<x-layouts.admin title="Abonnements">
    <x-header title="Abonnements" subtitle="Manage votre abonnement">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:tenants.create') }}"/>
        </x-slot:actions>
    </x-header>

 <livewire:admin.abonnements.abonnement-list />
</x-layouts.admin>
