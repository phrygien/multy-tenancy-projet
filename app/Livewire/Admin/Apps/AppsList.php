<?php

namespace App\Livewire\Admin\Apps;

use App\Models\Apps;
use Livewire\Component;

class AppsList extends Component
{
    public function render()
    {
        $apps = Apps::all();

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'App name'],
            ['key' => 'code', 'label' => 'App code'],
            ['key' => 'base_url', 'label' => 'App Url'],

        ];

        return view('livewire.admin.apps.apps-list', [
            'apps' => $apps,
            'headers' => $headers
        ]);
    }
}
