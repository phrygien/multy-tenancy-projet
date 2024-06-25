<?php

namespace App\Livewire\Admin\Packs;

use App\Models\Apps;
use App\Models\Pack;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;
use Spatie\Permission\Models\Permission;

class PackCreate extends Component
{
    use Toast;

    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['required', 'integer'])]
    public $amount;

    #[Validate(['required'])]
    public $app_id;

    public $permission = [];

    public function render()
    {
        $permissions = Permission::get();
        $apps = Apps::all();
        return view('livewire.admin.packs.pack-create', [
            'permissions' => $permissions,
            'apps' => $apps
        ]);
    }

    public function save()
    {
        $this->validate();
        $role = Pack::create(['name' => $this->name, 'guard_name' => 'web' ,'amount' => $this->amount, 'app_id' => $this->app_id]);
        $role->syncPermissions($this->permission);

        $this->reset();

        $this->success(
            'Données enregistré !',
            //'You were redirected to another url ...',
            redirectTo: '/packs'
        );

    }
}
