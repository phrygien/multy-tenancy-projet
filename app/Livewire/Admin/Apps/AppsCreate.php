<?php

namespace App\Livewire\Admin\Apps;

use Livewire\Component;

class AppsCreate extends Component
{
    /**
     * Render the view for creating a new application.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.admin.apps.apps-create');
    }
}
