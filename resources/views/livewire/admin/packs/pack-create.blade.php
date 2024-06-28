<div>
    <div class="grid grid-cols-2 gap-2 space-y-2">
        <x-form wire:submit="save">
            <x-card title="Info pack" subtitle="Details du pack (name, prix, et l'application)" separator progress-indicator>
                <select class="w-full mb-4 select select-primary" wire:model='app_id'>
                    <option value="" selected>Application ?</option>
                    @foreach ($apps as $app)
                    <option value="{{ $app->id }}">{{ $app->name }}</option>
                    @endforeach
                  </select>
                <x-input label="Nom du pack" wire:model="name" class="mb-4" />
                <x-input label="Prix" wire:model="amount" />
            </x-card>

            {{-- Notice `progress-indicator` target --}}
            <x-card title="Modules" subtitle="Modules pour le pack" separator progress-indicator="save2">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    {{-- <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permissions as $value)
                            <label><input type="checkbox" wire:model="permission[{{$value->id}}]" value="{{$value->id}}" class="checkbox checkbox-secondary">
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                    </div> --}}
                    <select wire:model="permission" multiple class="w-full max-w-xs select select-primary">
                        @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                </div>

            </x-card>

            <x-slot:actions>
                <x-button label="Annuler" />
                <x-button label="Enregistrer" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>

    </div>
</div>
