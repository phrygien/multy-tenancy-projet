<div>

    <x-card separator progress-indicator>
        <x-table :headers="$headers"
        :rows="$tenants"
        link="/tenants/{id}/details"
        with-pagination
        :sort-by="$sortBy"
        wire:model="selected"
        selectable
        @row-selection="console.log($event.detail)"
        >
        </x-table>
    </x-card>

</div>
