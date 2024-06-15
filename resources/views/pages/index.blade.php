<x-layouts.admin title="Home Page">
        <x-header title="{{ ucfirst(tenant('id')) }} Home">
            <x-slot:actions>
                <x-theme-toggle class="btn btn-circle btn-ghost" />
            </x-slot:actions>
        </x-header>
        <div class="space-y-4">
            <section id="stats" aria-labelledby="stats" class="grid grid-cols-6 gap-4">
                <x-stat title="Tenants" value="13" icon="o-circle-stack" class="col-span-2"/>
                <x-stat title="Actif Tenant" value="6" icon="o-server" class="col-span-2"/>
                <x-stat title="Inactif Tenant" value="150" icon="o-briefcase" class="col-span-2" />
                <x-stat title="Users" value="4" icon="o-user-group" class="col-span-2"/>
                <x-stat title="Abonnements" value="340" icon="o-bell-alert" class="col-span-2"/>
            </section>
            {{-- <livewire:tenants.stats />
            <livewire:tenants.department-list /> --}}
        </div>

</x-layouts.admin>
