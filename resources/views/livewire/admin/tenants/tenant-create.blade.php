<div>
    <x-header title="Ajouter tenant" subtitle="Créer votre tenant" separator />

    <x-card separator progress-indicator>

    <x-form wire:submit="save">
        {{--  Basic section  --}}
        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Basic" subtitle="Basic info from user" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-mary-input label="Nom Tenant" inline wire:model='name' />
            </div>
        </div>

        {{--  Details section --}}
        <hr class="my-5" />

        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Domain info" subtitle="Information sur le domain" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-mary-input label="Adresse email" inline icon="o-envelope" wire:model='email' disabled />
                <x-mary-input label="Domain Name" inline wire:model='domain_name' />
            </div>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" link="{{ route('pages:tenants')}}" />
            <x-button label="Valider" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
    </x-card>
</div>
