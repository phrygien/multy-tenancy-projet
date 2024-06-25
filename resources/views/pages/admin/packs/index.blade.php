<x-layouts.admin title="Packs">
    <x-header title="Packs Apps" subtitle="Gerer les pack application">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" link="{{ route('pages:packs.create') }}"/>
        </x-slot:actions>
    </x-header>

 <livewire:admin.packs.pack-list />
</x-layouts.admin>
