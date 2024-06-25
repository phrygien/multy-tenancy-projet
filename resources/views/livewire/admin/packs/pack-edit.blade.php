<div>
    <x-header title="Mise à jour pack" separator >
        <x-slot:actions>
            <x-theme-toggle class="btn btn-circle btn-ghost" />
        </x-slot:actions>
    </x-header>

    <x-form wire:submit.prevent="update">
        {{--  Basic section  --}}
        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Details" subtitle="Basic informations sur le pack" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-mary-input label="Pack name" inline wire:model='name' />
                <x-mary-input label="Prix pack ( par mois)" inline wire:model='amount' />
                <select class="w-full select select-primary" disabled>
                    <option selected>Application</option>
                    <option>Game of Thrones</option>
                    <option>Lost</option>
                    <option>Breaking Bad</option>
                    <option>Walking Dead</option>
                  </select>
            </div>
        </div>

        {{--  Details section --}}
        <hr class="my-5" />

        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Modules" subtitle="Les modules disponible pour ce pack" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                {{-- <select multiple class="form-control" wire:model="permission">
                    @foreach($permissions as $value)
                        <option value="{{ $value->id }}" {{ in_array($value->id, $permissionsSelected) ? 'selected' : '' }}>
                            {{ $value->name }}
                        </option>
                    @endforeach
                </select> --}}

                <select wire:model="permission" multiple id="countries_multiple" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($permissions as $value)
                    <option wire:key='{{ $value->id }}' value="{{ $value->id }}" {{ in_array($value->id, $permissionsSelected) ? 'selected' : '' }}>
                        {{ $value->name }}
                    </option>
                @endforeach
                  </select>

                @error('permission') <span class="error">{{ $message }}</span> @enderror

            </div>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Mise à jour" class="btn-primary" type="submit" spinner="update" />
        </x-slot:actions>
    </x-form>
</div>
