<div>
    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$schools" link="/schools/{id}/edit" with-pagination />
    </x-card>
</div>
