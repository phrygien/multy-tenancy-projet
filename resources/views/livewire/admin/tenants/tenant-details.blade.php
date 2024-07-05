<div class="grid gap-5 lg:grid-cols-2">

<div>
    <x-form wire:submit="save">
        {{--  Basic section  --}}
        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Domain" subtitle="Basic info for domain" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-input label="Nom de domain" wire:model="domain_name" />
                <x-input label="Tenant ID" wire:model="tenant_id" readonly />
            </div>
        </div>

        <hr class="my-5" />

        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Pricing" subtitle="Pack de votre abonnement" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <select class="w-full max-w-xs select select-primary" wire:model="pricing_id">
                    <option value="">Choisiz votre pack ?</option>
                    @foreach ($pricings as $p )
                        <option value="{{ $p->id }}">{{ $p->name }} / {{ $p->price}} Ar / (mois)</option>
                    @endforeach
                  </select>
            </div>

        </div>

        {{--  Details section --}}
        <hr class="my-5" />

        <div class="grid-cols-5 lg:grid">
            <div class="col-span-2">
                <x-header title="Abonnement" subtitle="Détails de votre abonnement" size="text-2xl" />
            </div>
            <div class="grid col-span-3 gap-3">
                <x-datetime label="Debut" wire:model="debut" icon="o-calendar" readonly />
                <x-datetime label="Fin" wire:model="fin" icon="o-calendar" readonly/>
            </div>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" />
            <x-button label="Valider" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>
<div>
    <img src="{{ asset('images/achat.png')}}" width="300" class="mx-auto" />
</div>
</div>
