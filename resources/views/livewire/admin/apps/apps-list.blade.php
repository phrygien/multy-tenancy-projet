<div>
    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$apps" link="/apps/{id}/details" />
    </x-card>
</div>
