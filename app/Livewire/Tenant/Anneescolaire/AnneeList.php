<?php

namespace App\Livewire\Tenant\Anneescolaire;

use App\Models\Anneescolaire;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class AnneeList extends Component
{
    use WithPagination;
    public function render()
    {
        $anneescolaires = DB::table('anneescolaires')
        ->join('schools', 'schools.id', '=', 'anneescolaires.school_id')
        ->select('anneescolaires.*', 'schools.school_name')
        ->paginate(10);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => "Nom de l'année scolaire (promotion)"],
            ['key' => 'debut', 'label' => 'Date debut'],
            ['key' => 'fin', 'label' => 'Date fin'],
            ['key' => 'is_open', 'label' => 'Statut'],
            ['key' => 'school_name', 'label' => 'Ecole'],
        ];

        return view('livewire.tenant.anneescolaire.annee-list', [
            'headers' => $headers,
            'anneescolaires' => $anneescolaires
        ]);
    }
}
