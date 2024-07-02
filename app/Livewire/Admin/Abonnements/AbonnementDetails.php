<?php

namespace App\Livewire\Admin\Abonnements;

use App\Models\Abonnement;
use Carbon\Carbon;
use Livewire\Component;
use Mary\Traits\Toast;

class AbonnementDetails extends Component
{
    use Toast;
    public bool $myModal1 = false;

    public Abonnement $abonnement;

    public $abonnement_id;
    public $pricing_id;

    public function mount(Abonnement $abonnement): void{
        $this->abonnement = $abonnement;
        $this->abonnement_id = $abonnement->id;
        $this->pricing_id = $abonnement->pricing_id;
    }

    public function render()
    {
        return view('livewire.admin.abonnements.abonnement-details');
    }

    public function renouvelement()
    {
        // avoir abonnement
        $subscription = Abonnement::find($this->abonnement_id);
        // Date actuelle
        $today = Carbon::today();

         // Abonnements expirant aujourd'hui
        //$expiringSubscriptions = Abonnement::where('fin', $today)->get();

        if($subscription)
        {
            Abonnement::create([
                'debut' => Carbon::today(),
                'fin' => Carbon::today()->addMonth(), // exemple pour un an
                'pricing_id' => $subscription->pricing_id,
                'user_id' => $subscription->user_id,
                'tenant_id' => $subscription->tenant_id,
                'statut' => 0,
                'is_active' => true,
            ]);

            // Optionnel: Mettre à jour l'ancien abonnement
            $subscription->update(['is_active' => false]);

            $this->success('Renouvelement avec succees !');
        }else{
            $this->warning('L\'abonement n\'est pas encore expire! ');
        }
    }
}
