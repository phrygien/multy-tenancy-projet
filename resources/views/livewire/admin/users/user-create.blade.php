<div>
    <x-header title="Ajouter" subtitle="Ajouter utilisateur avec tenant" separator />

    <x-card separator progress-indicator>

    <x-form wire:submit="save">
        {{--  Basic section  --}}
        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Basic" subtitle="Basic info from user" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-mary-input label="Nom et prenom" inline icon="o-user" />
            </div>
        </div>

        {{--  Details section --}}
        <hr class="my-5" />

        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Contact" subtitle="Resigner contact de l'utilisateur" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-mary-input label="Mobile Phone" inline icon="o-device-phone-mobile" />
                <x-mary-input label="Phone fixe" inline icon="o-phone" />
                <x-mary-input label="Adresse email" inline icon="o-envelope" />
            </div>
        </div>

        <hr class="my-5" />

        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Localisation" subtitle="Resigner l'adresse de l'utilisateur" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-mary-input label="Ville" inline icon="o-map-pin" />
                <x-mary-input label="Code Postal" inline icon="o-globe-europe-africa" />
                <x-mary-input label="Rue" inline icon="o-map" />
                <x-mary-input label="Adresse" inline icon="o-globe-europe-africa" />
            </div>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Valider" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
    </x-card>
</div>
