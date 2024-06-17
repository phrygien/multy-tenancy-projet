<div>
    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$users" link="/docs/installation/?from={username}" with-pagination />
    </x-card>
</div>
