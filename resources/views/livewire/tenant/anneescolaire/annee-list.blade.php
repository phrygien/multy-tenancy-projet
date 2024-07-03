<div>
    <x-header title="Année scolaire" subtitle="Gerer l'année scolaire pour la promotion">
        <x-slot:actions>
            <x-button icon="o-funnel" />
            <x-button icon="o-plus" class="btn-primary" label="Ajouter année scolaire" />
        </x-slot:actions>
    </x-header>

    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$anneescolaires" @row-click="alert($event.detail.name)" />
    </x-card>

</div>
