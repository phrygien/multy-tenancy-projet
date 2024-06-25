<?php

namespace App\Livewire\Admin\Packs;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class PackList extends Component
{
    use WithPagination;

    public function render()
    {
        $roles = DB::table('roles')->join('apps', 'apps.id', '=', 'roles.app_id')->select('roles.*', 'apps.name as app_name')->paginate(10);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Pack Name'],
            ['key' => 'amount', 'label' => 'Montant (Ar)'],
            ['key' => 'app_name', 'label' => 'Application']
        ];
        return view('livewire.admin.packs.pack-list', [
            'headers' => $headers,
            'roles' => $roles
        ]);
    }
}
