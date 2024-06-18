<?php

namespace App\Livewire\Admin\Apps;

use App\Models\Apps;
use App\Models\Module;
use App\Models\Pack;
use Livewire\Component;
use Mary\Traits\Toast;

class AppDetails extends Component
{
    use Toast;

    public Apps $app;

    public function mount(Apps $app): void
    {
        $this->app = $app;
    }

    public function render()
    {
        $app = $this->app;

        //pack de l'application
        $headers_pack = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'pack_name', 'label' => 'Pack'],
            ['key' => 'price_pack', 'label' => 'Price']
        ];
        $packs = Pack::where('apps_id', $app->id)->paginate(10);

        // get modules apps
        $headers_module = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'module_name', 'label' => 'Module'],
            ['key' => 'module_code', 'label' => 'Code']
        ];

        $modules = Module::where('apps_id', $app->id)->paginate(10);
        return view('livewire.admin.apps.app-details', [
            'app' => $app,
            "packs" => $packs,
            "headers_pack" => $headers_pack,
            "modules" => $modules,
            "headers_module" => $headers_module
        ]);
    }

    public function souscrire(Apps $app): void
    {
        $this->success('Souscription avec succèes ! ');
    }
}
