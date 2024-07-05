<?php

namespace App\Livewire\Tenant\Anneescolaire;

use App\Models\Anneescolaire;
use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use PhpParser\Node\Expr\FuncCall;

class AnneeList extends Component
{
    use WithPagination;
    use Toast;

    // for modal
    public bool $anneeModal = false;
    public bool $editMode = false;
    public bool $deleteModal = false;
    // properties
    #[Validate('required')]
    public string $name;

    #[Validate('required')]
    public $debut;

    #[Validate('required')]
    public $fin;

    #[Validate('required')]
    public $school_id;

    public $annee_id;

    public function showModal(): void
    {
        $this->reset();
        $this->anneeModal = true;
    }

    public function mount(): void
    {

    }

    public function render()
    {
        $ecoles = School::all();
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
            ['key' => '', 'label' => 'Action'],
        ];

        return view('livewire.tenant.anneescolaire.annee-list', [
            'headers' => $headers,
            'anneescolaires' => $anneescolaires,
            'ecoles' => $ecoles
        ]);
    }

    // save promotion
    public function save(): void
    {
        $this->validate();
        try {
            if($this->editMode)
            {
                $this->validate();
                $annee = Anneescolaire::find($this->annee_id);

                $annee->school_id = $this->school_id;
                $annee->name = $this->name;
                $annee->debut = $this->debut;
                $annee->fin = $this->fin;
                $annee->save();
                $this->editMode = false;
                $this->success('Mise a jour bien enregistré');
                $this->reset();
            }else{
                Anneescolaire::create([
                    'name' => $this->name,
                    'debut' => $this->debut,
                    'fin' => $this->fin,
                    'school_id' => $this->school_id
                ]);
                $this->success('Promotion bien enregistré');
                $this->reset();
            }
        } catch (\Exception $e) {
            $this->error('Promotion not saved !');
        }
    }

    public function edit($id): void
    {
        $annee = Anneescolaire::find($id);
        $this->annee_id = $annee->id;
        $this->name = $annee->name;
        $this->debut = $annee->debut;
        $this->fin = $annee->fin;
        $this->school_id = $annee->school_id;
        $this->editMode = true;
        $this->anneeModal = true;
    }

    /**
     * A function to confirm deletion.
     *
     * @param int $id The ID of the item to be deleted
     */
    public function confirmerDelete($id): void
    {
        $this->deleteModal = true;
        $annee = Anneescolaire::find($id);
        $this->annee_id = $annee->id;
    }
    /**
     * Deletes an annee from the database and performs related actions.
     *
     * @return void
     */
    public function delete(): void
    {
        Anneescolaire::find($this->annee_id)->delete();
        $this->success('Suppression bien enregistré');
        $this->deleteModal = false;
        $this->reset();
    }
}
