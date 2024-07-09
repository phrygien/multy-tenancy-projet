<?php

namespace App\Livewire\Tenant\Eleves;

use App\Helpers\Mecene;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\DB;

class EleveCreate extends Component
{
    use Toast;

    #[Validate('required')]
    public string $nom;

    #[Validate('nullable')]
    public string $prenom;

    #[Validate('nullable')]
    public string $sexe;

    #[Validate('required', 'date')]
    public string $date_naissance;

    public function render()
    {
        return view('livewire.tenant.eleves.eleve-create');
    }

    public function save()
    {
     $this->validate();
       try {
        $connected_user = Auth::user();
        // verification limit nb student
        $limitCheck = Mecene::hasReachedStudentLimit();

        if($limitCheck){
            return $this->warning($limitCheck['message']);
        }

       } catch (\Exception $e) {
        $this->error('Data Not Saved !');
       }
    }
}
