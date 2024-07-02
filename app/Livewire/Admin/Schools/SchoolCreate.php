<?php

namespace App\Livewire\Admin\Schools;

use App\Models\District;
use App\Models\Domain;
use App\Models\Province;
use App\Models\Region;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;

class SchoolCreate extends Component
{
    use Toast;
    use WithFileUploads;

    public $provinces;
    public $regions = [];
    public $districts = [];
    public $communes = [];

    #[Validate(['required'])]
    public string $url;

    #[Validate(['required'])]
    public string $tenant_id;

    #[Validate('required')]
    public string $school_name;

    #[Validate('required')]
    public string $identity;

    #[Validate('required')]
    public string $telephone_fixe;

    #[Validate('required')]
    public string $telephone_mobile;

    #[Validate('required')]
    public $province_id;

    #[Validate('required')]
    public $region_id;

    #[Validate('required')]
    public $district_id;

    #[Validate('required')]
    public $commune_id;

    public function mount(): void
    {
        $this->provinces = Province::all();

        $tenant = Auth::user()->tenant;
        $domain = Domain::where('tenant_id', $tenant->id)->first();
        $this->url = 'https://'.$domain->domain;
        $this->tenant_id = $tenant->id;
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $province_id description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function updatedProvinceId($province_id)
    {
        $this->regions = Region::where('id_province', $province_id)->orderBy('nom')->get();
    }

    public function updatedRegionId($region_id)
    {
        $this->districts = District::where('id_region', $region_id)->orderBy('libelle')->get();
    }

    /**
     * Renders the view for the school creation form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.admin.schools.school-create');
    }

    public function save(){
        $this->validate();
        $this->success('L\'école a été créée !');
    }
}
