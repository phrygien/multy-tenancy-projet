<?php

namespace App\Livewire\Admin\Schools;

use App\Models\School;
use Livewire\Component;

class SchoolEdit extends Component
{
    public School $school;

    public function mount(School $school): void
    {
        $this->school = $school;
    }

    public function render()
    {
        return view('livewire.admin.schools.school-edit');
    }
}
