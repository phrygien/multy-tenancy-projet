<div>
    <x-header title="Abonnements" subtitle="Gerer votre abonnement">
        <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-button icon="o-funnel" wire:click="$toggle('showDrawer2')" />
        </x-slot:actions>
    </x-header>

    <x-card separator progress-indicator>
        <x-table :headers="$headers" :rows="$abonnements" link="/abonnements/{id}/details" with-pagination >
            @scope('cell_is_active', $abonnement)
            @if($abonnement->is_active ==0 )
                <div class="badge badge-secondary">Expieré</div>
            @endif
            @if($abonnement->is_active ==1 )
                <div class="badge badge-success">En cours</div>
            @endif
            @endscope

            @scope('cell_statut', $abonnement)
            @if($abonnement->statut ==0 )
                <div class="badge badge-secondary">Non payer</div>
            @endif
            @if($abonnement->statut ==1 )
                <div class="badge badge-success">Paiment Ok</div>
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
