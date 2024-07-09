<div>
    <x-header title="Students" separator progress-indicator />
    <div class="grid gap-5 lg:grid-cols-2">
            <div>
                <x-form wire:submit="save">
                    <div class="grid-cols-5 lg:grid">
                        <div class="col-span-2">
                            <x-header title="Parents" subtitle="En savoir plus sur les parent" size="text-2xl" />
                        </div>
                        <div class="grid col-span-3 gap-3">
                            <x-input label="Nom et prenom pere" placeholder="" wire:model='nom_prenom_pere' hint="" />
                            <x-input label="Fonction pere" placeholder="" wire:model='foction_pere' hint="" />
                            <x-input label="Nom et prenom mere" placeholder="" wire:model='nom_prenom_mere' hint="" />
                            <x-input label="Fonction mere" placeholder="" wire:model='foction_mere' hint="" />
                        </div>
                    </div>

                    <hr class="my-5" />


                    <div class="grid-cols-5 lg:grid">
                        <div class="col-span-2">
                            <x-header title="Basic" subtitle="En savoir plus sur l'école" size="text-2xl" />
                        </div>
                        <div class="grid col-span-3 gap-3">
                            <x-input label="Nom" wire:model='nom' />
                            <x-input label="Prenoms" wire:model='prenoms' />
                            <x-datetime label="Date de naissance" wire:model='date_naissance' />
                            <x-input label="Lieu de naissance" wire:model='lieu_naissance' />
                        </div>
                    </div>
                    <hr class="my-5" />

                    <div class="grid-cols-5 lg:grid">
                        <div class="col-span-2">
                            <x-header title="Contacts" subtitle="En savoir plus sur le contact" size="text-2xl" />
                        </div>
                        <div class="grid col-span-3 gap-3">
                            <x-input label="Télephone" placeholder="" wire:model='telephone' hint="" />
                            <x-input label="Email" placeholder="" wire:model='email' hint="" />
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
