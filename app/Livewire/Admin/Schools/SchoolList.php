<?php

namespace App\Livewire\Admin\Schools;

use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\DB;

class SchoolList extends Component
{
    use WithPagination;
    use Toast;
    /**
     * Renders the view for the school list Livewire component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $schools = DB::table('schools')->join('province', 'province.id', '=', 'schools.province_id')->select('schools.*', 'provinces.name as province_name')->paginate(10);
        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'school_name', 'label' => 'Nom etablisement'],
            ['key' => 'abreviation', 'label' => 'Abreviation'],
            ['key' => 'identity', 'label' => 'Identité Code'],
            ['key' => 'telephone_fixe', 'label' => 'Numéro fixe'],
            ['key' => 'telephone_mobile', 'label' => 'Numéro mobile'],
            ['key' => 'province_name', 'label' => 'Province'],
        ];

        return view('livewire.admin.schools.school-list', [
            'headers' => $headers,
            'schools' => $schools
        ]);
    }
}
