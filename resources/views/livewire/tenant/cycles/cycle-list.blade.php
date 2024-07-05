<div>
    <x-header title="Sections" subtitle="Gerer les cycle ou la section de votre école">
        <x-slot:actions>
            <x-button icon="o-funnel" />
            <x-button icon="o-plus" class="btn-primary" wire:click="$toggle('showDrawer2')"/>
        </x-slot:actions>
    </x-header>
    <div class="grid gap-5 lg:grid-cols-2">
        <dv>
            <x-card>
                <x-table :headers="$headers" :rows="$cycles" striped link="/docs/installation/?from={username}" with-pagination>
                    @scope('cell_is_active', $cycle)
                    @if($cycle->is_active ==0 )
                        <div class="badge badge-warning">Inactif</div>
                    @endif
                    @if($cycle->is_active ==1 )
                        <div class="badge badge-primary">Actif</div>
                    @endif
                    @endscope

                    @scope('actions', $cycle)
                        <x-button icon="o-trash" wire:click="confirmerDelete({{ $cycle->id }})" spinner class="btn-sm btn-secondary" />
                    @endscope
                </x-table>
            </x-card>
        </dv>

        <div>
            {{-- Get a nice picture from `StorySet` web site --}}
            <img src="{{ asset('/images/cycle-image.png') }}" width="300" class="mx-auto" />
        </div>
    </div>

    <x-drawer
        wire:model="showDrawer2"
        title="Ajout"
        subtitle="Ajouter une nouvelle section"
        separator
        close-on-escape
        class="w-11/12 lg:w-1/3"
        right
        >
        <div>
            <x-form wire:submit="save">
                <x-select
                label="Alternative"
                :options="$ecoles"
                option-value="id"
                option-label="school_name"
                placeholder="Ecole ?"
                placeholder-value="0"
                hint=""
                wire:model.live="school_id" />
                <x-input label="Nom de la section" wire:model="cycle_name" inline />
                <x-input label="Abreviation" wire:model="abreviation" inline />
                <x-slot:actions>
                    <x-button label="Fermer" @click="$wire.showDrawer2 = false"/>
                    <x-button label="Ajouter" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </div>
    </x-drawer>

</div>
