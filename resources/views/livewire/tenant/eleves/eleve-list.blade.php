<div>
    <div>
        <x-header title="Eleves" subtitle="Gerer les éleves de votre école" separator >
            <x-slot:middle class="!justify-end">
                <x-input icon="o-magnifying-glass" placeholder="Numéro matricule..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-button icon="o-funnel" label="Filter" />
                <x-button icon="o-plus-circle" class="btn-primary" label="Création" />
            </x-slot:actions>
        </x-header>

        <x-card separator progress-indicator>
            <x-table :headers="$headers" :rows="$eleves" link="/docs/installation/?from={username}" />
        </x-card>

    </div>
</div>
