<x-form wire:submit="submit">
            <x-mary-input label="Email" wire:model='email' inline icon="o-envelope"/>
            <x-mary-input wire:model='password' label="Mot de passe" inline icon="o-key" />
        <x-slot:actions>
            <x-button label="Connexion" class="btn-primary" type="submit" spinner="submit" icon="o-paper-airplane" />
        </x-slot:actions>
    </x-form>
</section>
