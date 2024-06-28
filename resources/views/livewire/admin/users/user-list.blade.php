<div>
    {{-- Tenants users --}}
    @if (Auth::user()->is_admin == 1)
    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$users" link="/docs/installation/?from={username}" with-pagination />
    </x-card>

    @else
    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$users" link="/docs/installation/?from={username}" with-pagination />
    </x-card>

    <x-card title="Application users" subtitle="Utilisateurs de votre plateforme" separator progress-indicator class="mt-4">
        <x-table :headers="$tenant_headers" :rows="$tenant_users" link="/docs/installation/?from={username}" @if(count($tenant_users) > 0) with-pagination  @endif/>
    </x-card>
    @endif

</div>
