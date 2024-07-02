<div>
    <x-header title="Abonnement Details" subtitle="Details de l'abonnement">
        <x-slot:actions>
            <x-button icon="o-arrow-path" class="btn-secondary" label="Changement de pack" />
            {{-- @if($abonnement->is_active !=0 ) --}}
            <x-button wire:click='renouvelement()' icon="o-credit-card" class="btn-primary" label="Renouveler" />
            {{-- @endif --}}
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal1" class="backdrop-blur" persistent>
        <div class="mb-5">
            <x-form wire:submit="save">
                <x-input label="Name" wire:model="name" />
                <x-input label="Amount" wire:model="amount" prefix="USD" money hint="It submits an unmasked value" />

                <x-slot:actions>
                    <x-button label="Cancel" @click="$wire.myModal1 = false" />
                    <x-button label="Click me!" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </div>
    </x-modal>
</div>
