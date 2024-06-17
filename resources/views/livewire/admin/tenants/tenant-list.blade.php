<div>
    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$tenants" link="/docs/installation/?from={username}" />
    </x-card>
</div>
