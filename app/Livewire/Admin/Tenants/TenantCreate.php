<?php

namespace App\Livewire\Admin\Tenants;

use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class TenantCreate extends Component
{
    use Toast;

    public $id;

    #[Validate(['required', 'max:150'])]
    public $domain_name;

    #[Validate(['required', 'max:150'])]
    public $name;

    #[Validate(['required', 'max:150'])]
    public $email;

    public function mount(): void
    {
        $this->email = Auth::user()->email;
    }

    public function render()
    {
        return view('livewire.admin.tenants.tenant-create');
    }

    public function save()
    {
        // $validatedData = $this->validate([
        //     'id' => 'nullable',
        //     'name' => ['required', 'string'],
        //     'domain_name' => ['required', 'string', 'min:5', 'max:8', 'unique:domains,domain'],
        //     'email' => ['required', 'email', 'unique:tenants,email'],
        // ]);
        $this->validate();

        $tenant = Tenant::create([
            'id' => $this->name,
            'name' => $this->name,
            'email' => $this->email,
            'user_id' => Auth::user()->id
        ]);

        // $createdTenant = Tenant::findOrFail($tenant->id);
        // $createdTenant->user_id = Auth::user()->id;
        // $createdTenant->save();

        $tenant->domains()->create([
            'domain' => $this->domain_name.'.'.config('app.domain'),
        ]);

        $this->reset();

        session()->flash('message', 'Your tenant is saved !');

        $this->redirect(
            url: route('pages:tenants'),
        );
    }
}
