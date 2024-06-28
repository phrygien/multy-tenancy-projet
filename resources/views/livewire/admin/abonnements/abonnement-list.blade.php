<div>
    <x-header title="Abonnements" subtitle="Gerer votre abonnement">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" wire:click="$toggle('showDrawer2')" />
            <x-button icon="o-plus" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$abonnements" link="/docs/installation/?from={username}" >
            @scope('cell_state', $abonnement)
            @if($abonnement->state ==0 )
                <div class="badge badge-primary">Impayé</div>
            @endif
            @if($abonnement->state ==1 )
                <div class="badge badge-accent">Payé</div>
            @endif
            @if($abonnement->state ==2 )
                <div class="badge badge-secondary">Expiré</div>
            @endif
            @endscope
        </x-table>
    </x-card>

    <x-drawer wire:model="showDrawer2" class="w-11/12 lg:w-1/3" title="Filtre abonnement"
    subtitle="Rechercher vos abonnement"
    separator right>
        <div>...</div>
        <x-button label="Close" @click="$wire.showDrawer2 = false" />
    </x-drawer>
</div>
