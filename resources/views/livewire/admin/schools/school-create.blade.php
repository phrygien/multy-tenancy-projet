<div>
    <x-header title="Ajouter école" separator progress-indicator />

    <!-- Grid stuff from Tailwind -->
    <div class="grid gap-5 lg:grid-cols-2">
        <div>
            <x-form wire:submit="save">
                <div class="lg:grid grid-cols-5">
                    <div class="col-span-2">
                        <x-header title="Logo" subtitle="Logo de l'école" size="text-2xl" />
                    </div>
                    <div class="col-span-3 grid gap-3">
                        <x-file wire:model="photo" accept="image/png, image/jpeg">
                            <img src="{{ $user->avatar ?? 'https://flow.mary-ui.com/images/empty-user.jpg' }}" class="h-40 rounded-lg" />
                        </x-file>
                    </div>
                </div>

                <hr class="my-5" />

                <div class="lg:grid grid-cols-5">
                    <div class="col-span-2">
                        <x-header title="Basic" subtitle="En savoir plus sur l'école" size="text-2xl" />
                    </div>
                    <div class="col-span-3 grid gap-3">
                        <x-input label="Nom" placeholder="" wire:model='school_name' hint="" />
                        <x-input label="Abreviation" placeholder="" wire:model='abreviation' hint="" />
                        <x-input label="Identification" placeholder="" wire:model='identity' hint="Code d'identification unique de cotre ecole" disabled />
                        {{-- <x-input label="Plateforme Accée" placeholder="" wire:model='tenant_id' hint="" disabled />
                            <x-input label="Url" placeholder="" wire:model='url' hint="Site pour accédé au ecole" disabled /> --}}
                    </div>
                </div>
                <hr class="my-5" />

                <div class="lg:grid grid-cols-5">
                    <div class="col-span-2">
                        <x-header title="Contacts" subtitle="En savoir plus sur le contact" size="text-2xl" />
                    </div>
                    <div class="col-span-3 grid gap-3">
                        <x-input label="Numéro fixe" placeholder="" wire:model='telephone_fixe' hint="" />
                        <x-input label="Numéro Mobile" placeholder="" wire:model='telephone_mobile' hint="" />
                        <x-input label="Email" placeholder="" wire:model='email' hint="" />
                    </div>
                </div>

                <hr class="my-5" />

                <div class="lg:grid grid-cols-5">
                    <div class="col-span-2">
                        <x-header title="Lieu" subtitle="En savoir plus sur le lieu" size="text-2xl" />
                    </div>
                    <div class="col-span-3 grid gap-3">
                        <x-select
                        label="Alternative"
                        :options="$provinces"
                        option-value="id"
                        option-label="nom"
                        placeholder="Province ?"
                        placeholder-value="0"
                        hint=""
                        wire:model.live="province_id" />

                        <x-select
                        label="Region"
                        :options="$regions"
                        option-value="id"
                        option-label="nom"
                        placeholder="Region ?"
                        placeholder-value="0"
                        hint=""
                        wire:model.live="region_id" />

                        <x-select
                        label="District"
                        :options="$districts"
                        option-value="id"
                        option-label="libelle"
                        placeholder="District ?"
                        placeholder-value="0"
                        hint=""
                        wire:model.live="district_id" />

                        <x-select
                        label="Commune"
                        :options="$communes"
                        option-value="id"
                        option-label="nom"
                        placeholder="Commune ?"
                        placeholder-value="0"
                        hint=""
                        wire:model="commune_id" />

                        <x-input label="Adresse exacte" icon-right="o-map-pin" placeholder="" wire:model='adresse' hint="" />

                    </div>
                </div>

                <x-slot:actions>
                    <x-button label="Annuler" link="/schools" />
                    <x-button label="Valider" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </div>
        <div>
            {{-- Get a nice picture from `StorySet` web site --}}
            <img src="{{ asset('images/edit-form.png') }}" width="300" class="mx-auto" />
        </div>
    </div>
</div>
