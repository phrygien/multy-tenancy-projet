<?php

namespace App\Livewire\Admin\Schools;

use App\Models\Commune;
use App\Models\District;
use App\Models\Domain;
use App\Models\Province;
use App\Models\Region;
use App\Models\School;
use App\Models\Tenant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mary\Traits\Toast;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

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
    public string $abreviation;

    #[Validate('required')]
    public string $identity;

    #[Validate('required')]
    public string $telephone_fixe;

    #[Validate('required')]
    public string $telephone_mobile;

    #[Validate('required')]
    public string $email;

    #[Validate('required')]
    public $province_id;

    #[Validate('required')]
    public $region_id;

    #[Validate('required')]
    public $district_id;

    #[Validate('required')]
    public $commune_id;

    #[Validate('required')]
    public string $adresse;

    function generateUniqueId($length = 7) {
        do {
            $uniqueId = Str::random($length);
        } while (School::where('identity', $uniqueId)->exists());

        return $uniqueId;
    }

    public function mount(): void
    {
        $this->provinces = Province::all();

        $tenant = Auth::user()->tenant;
        $domain = Domain::where('tenant_id', $tenant->id)->first();
        $this->url = 'https://'.$domain->domain;
        $this->tenant_id = $tenant->id;
        $this->identity = strtoupper($this->generateUniqueId().'-'.$tenant->id);
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

    /**
     * Updates the districts based on the given region ID.
     *
     * @param int $region_id The ID of the region.
     * @return void
     */
    public function updatedRegionId($region_id)
    {
        $this->districts = District::where('id_region', $region_id)->orderBy('libelle')->get();
    }

    public function updatedDistrictId($district_id)
    {
        $this->communes = Commune::where('id_district', $district_id)->orderBy('nom')->get();
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
        try {
            DB::beginTransaction();
            School::create([
                'school_name' => $this->school_name,
                'abreviation' => $this->abreviation,
                'identity' => $this->identity,
                'tenant_id' => $this->tenant_id,
                'url' => $this->url,
                'telephone_phixe' => $this->telephone_fixe,
                'telephone_mobile' => $this->telephone_mobile,
                'email' => $this->email,
                'province_id' => $this->province_id,
                'region_id' => $this->region_id,
                'district_id' => $this->district_id,
                'commune_id' => $this->commune_id,
                'adresse' => $this->adresse,
                'is_published' => true,
                'user_id' => Auth::user()->id,
            ]);

             // save school to tenant DB
             $connected_user = Auth::user();
             if ($connected_user && $connected_user->tenant) {
                $tenant = $connected_user->tenant;
                    $db = 'tenant_'.$tenant->id;

                    if($db){
                        config(['database.connections.tenant.database' => $db]);
                            DB::purge('tenant');
                            DB::reconnect('tenant');

                            DB::connection('tenant')->getPdo();

                            // Insérer l'abonnement dans la base de données du tenant
                            DB::connection('tenant')->table('schools')->insert([
                                'school_name' => $this->school_name,
                                'abreviation' => $this->abreviation,
                                'identity' => $this->identity,
                                'tenant_id' => $this->tenant_id,
                                'url' => $this->url,
                                'telephone_phixe' => $this->telephone_fixe,
                                'telephone_mobile' => $this->telephone_mobile,
                                'email' => $this->email,
                                'province_id' => $this->province_id,
                                'region_id' => $this->region_id,
                                'district_id' => $this->district_id,
                                'commune_id' => $this->commune_id,
                                'adresse' => $this->adresse,
                                'is_published' => true,
                                'user_id' => Auth::user()->id,
                            ]);

                        DB::commit();
                    }
                }
            $this->success('L\'école a été créée !');

        } catch (\Exception $e) {
            dd($e->getMessage());
            $this->error('Data not saved !');
        }

    }

}
