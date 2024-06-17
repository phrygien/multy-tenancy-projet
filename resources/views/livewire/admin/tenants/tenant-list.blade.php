<div>

    <x-card separator progress-indicator>
        <x-table :headers="$headers"
        :rows="$tenants"
        link="/docs/installation/?from={username}"
        with-pagination
        :sort-by="$sortBy"
        wire:model="selected"
        selectable
        @row-selection="console.log($event.detail)"
        >
        </x-table>
    </x-card>

</div>
