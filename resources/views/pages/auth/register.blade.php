<x-layouts.page title="Sign into your account">
    <div class="w-full mt-10 sm:mx-auto sm:max-w-sm ">
            <x-form wire:submit="save">
                {{--  Basic section  --}}
                <div class="grid-cols-5 lg:grid">
                    <div class="col-span-2">
                        <x-header title="Basic" subtitle="Basic info from user" size="text-2xl" />
                    </div>
                    <div class="grid col-span-3 gap-3">
                        <x-mary-input inline label="First Name" icon="o-user" />
                        <x-mary-input inline label="Last Name" icon="o-user" />
                    </div>
                </div>

                {{--  Details section --}}
                <hr class="my-5" />

                <div class="grid-cols-5 lg:grid">
                    <div class="col-span-2">
                        <x-header title="Seecurity" subtitle="More about the user" size="text-2xl" />
                    </div>
                    <div class="grid col-span-3 gap-3">
                        <x-mary-input inline label="Email" icon="o-envelope" />
                        <x-mary-input inline label="Password"  icon="o-key"/>
                        <x-mary-input inline label="Confirmer password" icon="o-key" />
                    </div>
                </div>

                <x-slot:actions>
                    <x-button label="Cancel" />
                    <x-button label="Valider" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
</x-layouts.page>
