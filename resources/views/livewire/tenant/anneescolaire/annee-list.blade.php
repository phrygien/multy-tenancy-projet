<div>
    <x-header title="Année scolaire" subtitle="Gerer l'année scolaire pour la promotion">
        <x-slot:actions>
            <x-button icon="o-funnel" />
            <x-button icon="o-plus" class="btn-primary" label="Créer une année" @click="$wire.showModal()" />
        </x-slot:actions>
    </x-header>

    <x-card separator progress-indicator>
        <x-dropdown class="mb-3">
            <x-menu-item title="Ouvrir" icon="o-archive-box" />
            <x-menu-item title="Fermer" icon="o-trash" />
        </x-dropdown>

        <x-table :headers="$headers" :rows="$anneescolaires" @row-click="$wire.edit($event.detail.id)">
            @scope('cell_is_open', $annee)
            @if($annee->is_open ==0 )
                <div class="badge badge-secondary">Fermé</div>
            @endif
            @if($annee->is_open ==1 )
                <div class="badge badge-success">Ouvert</div>
            @endif
            @endscope

            @scope('actions', $annee)
                <x-button icon="o-trash" wire:click="confirmerDelete({{ $annee->id }})" spinner class="btn-sm" />
            @endscope

        </x-table>

    </x-card>

    <x-mary-modal wire:model="anneeModal" class="backdrop-blur" title="Ajout Annee">
        <div class="mb-5">
            <x-form wire:submit="save">
                {{-- Notice `error_field` --}}
                <x-select
                label="Alternative"
                :options="$ecoles"
                option-value="id"
                option-label="school_name"
                placeholder="Ecole ?"
                placeholder-value="0"
                hint=""
                wire:model.live="school_id" />

                <x-mary-input label="Nom de l'annee (promotion)" wire:model="name" />
                <x-datetime label="Date debut" wire:model="debut" icon="o-calendar" />
                <x-datetime label="Date fin" wire:model="fin" icon="o-calendar" />
                <x-slot:actions>
                    <x-mary-button label="Annuler" @click="$wire.anneeModal = false" />
                    <x-mary-button label="Valider" class="btn-primary" type="submit" spinner="save" icon="o-paper-airplane" />
                </x-slot:actions>
            </x-form>
        </div>
    </x-mary-modal>

    <x-modal wire:model="deleteModal" class="backdrop-blur" persistent>
        <div class="mb-5">Cliquer sur `Confirmer` pour supprimer, ou `ANNULER` pour annuler la suppression.</div>
        <x-button label="Annuler" @click="$wire.deleteModal = false" />
        <x-button label="Confirmer" wire:click='delete()' class="btn-secondary" />
    </x-modal>

</div>
