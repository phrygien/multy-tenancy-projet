<div>
    <x-header title="{{ $app->name }}" subtitle="Details">
        <x-slot:middle class="!justify-end">
            {{-- <x-input icon="o-bolt" placeholder="Search..." /> --}}
        </x-slot:middle>
        <x-slot:actions>
            @if(Auth::user()->is_admin == 1)
            <x-button icon="o-trash" class="btn-error" label="Désactiver" />
            @endif
            <x-button icon="o-currency-euro" class="btn-primary" label="Souscrire" wire:click='souscrire()' />
        </x-slot:actions>
    </x-header>

<div class="p-5 rounded-lg shadow-sm card bg-base-100" wire:key="maryfe2c4520cee98a7fa7867a379ba3b286">
        <div class="pb-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold ">
                        Info
                    </div>
                </div>
            </div>
            <hr class="mt-3">
        </div>
        <div>
            <div class="flex items-center gap-2">
                <div class="avatar">
                    <div class="w-7 rounded-full !w-20">
                        <img src="https://picsum.photos/200?x=586761771">
                    </div>
                </div>
                <div>
                    <div class="pl-2 font-semibold font-lg">
                        {{ $app->name }}
                    </div>
                    <div class="flex flex-col gap-2 p-2 pl-2 text-sm text-gray-400">
                        <div class="inline-flex items-center gap-1">
                            <div class="">
                                {{ $app->base_url }}
                            </div>
                        </div>
                        <div class="inline-flex items-center gap-1">
                            <div class="color-primary font-semi-bolde">
                                {{ $app->code }}
                            </div>
                        </div>
                        <div class="inline-flex items-center gap-1">
                            <div class="font-bold">
                                {{ $app->description }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Packs disponible --}}
    <x-card class="mt-4" title="App Packs" subtitle="Toutes les pack disponible" separator progress-indicator="save2">
        <x-table :headers="$headers_pack" :rows="$packs" striped @row-click="alert($event.detail.pack_name)" />
    </x-card>

    {{-- Modules disponible --}}
    <x-card class="mt-4" title="App Modules" subtitle="Module concernant l'aplication" separator progress-indicator="save2">
        <x-table :headers="$headers_module" :rows="$modules" striped @row-click="alert($event.detail.module_name)" />
    </x-card>
</div>
