<?php

namespace App\Livewire\Admin\Packs;

use Livewire\Component;
use Mary\Traits\Toast;
use App\Models\Pack;
use Illuminate\Foundation\Console\PackageDiscoverCommand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Spatie\Permission\Models\Permission;

class PackEdit extends Component
{
    use Toast;
    public Pack $pack;
    public $user_id;
    public $pack_id;

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $amount;

    public $app_id;
    public $permission = [], $permissionsSelected = [];

    public function mount(Pack $pack): void
    {
        $this->pack = $pack;

        $this->pack_id = $pack->id;
        $this->user_id = Auth::user()->id;

        $this->name = $pack->name;
        $this->amount = $pack->amount;
        $this->app_id = $pack->app_id;
        $this->permissionsSelected =  DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->pack_id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        $this->permission = $this->permissionsSelected;

    }

    public function render()
    {
        $permissions = Permission::get();
        // $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$this->pack_id)
        //     ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        //     ->all();

        return view('livewire.admin.packs.pack-edit', [
            'permissions' => $permissions,
            //'rolePermissions' => $rolePermissions
        ]);
    }

    public function update(Pack $pack): void
    {
        $this->validate();

        $pack = Pack::find($this->pack_id);
        $pack->update(['name' => $this->name, 'amount' => $this->amount]);
        $pack->syncPermissions($this->permission);

        //$this->reset();

        $this->success(
            'Mise à jour pack Saved !',
            //'You were redirected to another url ...',
            redirectTo: '/packs'
        );
    }
}
