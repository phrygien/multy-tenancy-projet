<?php

namespace App\Livewire\Tenant\Cycles;

use App\Models\Cycle;
use App\Models\School;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class CycleList extends Component
{

    use WithPagination;
    use Toast;

    public bool $showDrawer2 = false;

    //properties
    #[Validate('required')]
    public string $cycle_name;

    #[Validate('required')]
    public string $abreviation;

    #[Validate('required')]
    public $school_id;

    public $is_active = 1;

    public function mount(): void
    {
        $this->is_active = 1;
    }

    public function render()
    {
        $ecoles = School::all();

        $cycles = Cycle::paginate(10);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'cycle_name', 'label' => 'Nom section'],
            ['key' => 'cycle_abreviation', 'label' => 'Abreviation'],
            ['key' => 'is_active', 'label' => 'Status']
        ];

        return view('livewire.tenant.cycles.cycle-list', [
            'headers' => $headers,
            'cycles' => $cycles,
            'ecoles' => $ecoles
        ]);
    }

    public function save(): void
    {
        $this->validate();
        Cycle::create([
            'cycle_name' => $this->cycle_name,
            'cycle_abreviation' => $this->abreviation,
            'school_id' => $this->school_id,
            'is_active' => $this->is_active
        ]);

        $this->success('Section bien enregistré');
        $this->reset();
        $this->showDrawer2 = false;
    }
}
