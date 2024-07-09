<?php

namespace App\Livewire\Tenant\Eleves;

use App\Models\Eleve;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class EleveList extends Component
{
    use WithPagination;
    use Toast;

    public function render()
    {
        $eleves = DB::table('eleves')
                    ->join('schools', 'schools.id', 'eleves.school_id')
                    ->join('parenteleves', 'parenteleves.id', 'eleves.parent_id')
                    ->select('eleves.*', 'parenteleves.nom_prenom_pere', 'parenteleves.nom_prenom_mere', 'parenteleves.telephone', 'parenteleves.email', 'parenteleves.adresse', 'parenteleves.fonction_pere', 'parenteleves.fonction_mere')
                    ->paginate(20);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'nom', 'label' => 'Nom'],
            ['key' => 'prenoms', 'label' => 'Prenoms'],
            ['key' => 'date_naissance', 'label' => 'Date de naissance'],
            ['key' => 'adresse', 'label' => 'Adresse'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'matricule', 'label' => 'Matricule'],
            ['key' => 'nom_prenom_pere', 'label' => 'Parent'],
        ];

        return view('livewire.tenant.eleves.eleve-list', [
            'headers' => $headers,
            'eleves' => $eleves
        ]);
    }

}
