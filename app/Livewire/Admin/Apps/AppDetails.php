<?php

namespace App\Livewire\Admin\Apps;

use App\Models\Apps;
use App\Models\Module;
use App\Models\Pack;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;

class AppDetails extends Component
{
    use Toast;

    public Apps $app;
    public bool $showDrawer2 = false;

    #[Validate(['required', 'integer'])]
    public $pack_id;

    #[Validate(['required', 'integer'])]
    public $price = 0;

    #[Validate(['required', 'date'])]
    public $subscribe_start;

    #[Validate(['required', 'date'])]
    public $subscribe_end;

    public $user_id;
    public $app_id;

    public function mount(Apps $app): void
    {
        $this->app = $app;
        $this->app_id = $app->id;
        $this->user_id = Auth::user()->id;
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

    public function updatedPackId($property)
    {
        if($property)
        {
            $selectedPack = Pack::find($property);
            $this->price = $selectedPack->price_pack;
        }
    }

    public function subscribe()
    {
        $this->validate();

        Subscribe::create([
            'user_id' => $this->user_id,
            'apps_id' => $this->app_id,
            'pack_id' => $this->pack_id,
            'subscribe_start' => $this->subscribe_start,
            'subscribe_end' => $this->subscribe_end
        ]);

        $this->success('Souscription avec succèes ! ');

        //$this->reset();
        $this->showDrawer2 = false;

    }
}
