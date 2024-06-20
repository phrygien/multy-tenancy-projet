<div>
    <x-header title="Abonnements" subtitle="Gerer votre abonnement">
        {{-- <x-slot:middle class="!justify-end">
            <x-input icon="o-bolt" placeholder="Search..." />
        </x-slot:middle> --}}
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


</div>
