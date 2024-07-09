<?php

namespace App\Livewire\Admin\Tenants;

use App\Models\Abonnement;
use App\Models\Domain;
use App\Models\Pricing;
use App\Models\Tenant;
use Livewire\Component;
use Mary\Traits\Toast;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;

class TenantDetails extends Component
{
    use Toast;

    public Tenant $tenant;

    #[Validate('required')]
    public $tenant_id;

    #[Validate('required')]
    public $pricing_id;

    #[Validate('required')]
    public $domain_name;

    public $pricings = [];
    public $data;

    #[Validate('required')]
    public $debut;

    #[Validate('required')]
    public $fin;

    public function mount(Tenant $tenant): void
    {
        $this->tenant = $tenant;
        $this->tenant_id = $tenant->id;
        $this->pricings = Pricing::all();
        $this->data = $tenant->data;

        $this->debut = Carbon::now()->format('Y-m-d');
        $this->fin = Carbon::now()->addMonth()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.admin.tenants.tenant-details');
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            Domain::create([
                'domain' => $this->domain_name.'.'.config('app.domain'),
                'tenant_id' => $this->tenant_id
            ]);

            // abonnement pricipal
            Abonnement::create([
                'debut' => $this->debut,
                'fin' => $this->fin,
                'pricing_id' => $this->pricing_id,
                'user_id' => Auth::user()->id,
                'tenant_id' => $this->tenant_id,
            ]);

            // save abonement to tenant DB
            $connected_user = Auth::user();

            // insert pricing in to tenant DB
            if ($connected_user && $connected_user->tenant) {
                $tenant = $connected_user->tenant;
                    $db = 'tenant_'.$tenant->id;

                    if($db){
                        config(['database.connections.tenant.database' => $db]);
                            DB::purge('tenant');
                            DB::reconnect('tenant');

                            DB::connection('tenant')->getPdo();

                            // Insérer l'abonnement dans la base de données du tenant
                            DB::connection('tenant')->table('abonnements')->insert([
                                'user_id' => Auth::user()->id,
                                'debut' => $this->debut,
                                'fin' => $this->fin,
                                'pricing_id' => $this->pricing_id,
                                'tenant_id' => $this->tenant_id,
                            ]);
                    }


                DB::commit();

                $this->success('Souscription avec succèes ! ');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            //$this->error('Souscription echoué ! ');
        }

    }
}
