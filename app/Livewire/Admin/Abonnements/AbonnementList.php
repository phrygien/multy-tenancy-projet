<?php

namespace App\Livewire\Admin\Abonnements;

use App\Models\Subscribe;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AbonnementList extends Component
{
    public function render()
    {
        $abonnements = DB::table('subscribes')
                        ->join('users', 'users.id', 'subscribes.user_id')
                        ->join('apps', 'apps.id', 'subscribes.apps_id')
                        ->join('packs', 'packs.id','subscribes.pack_id')
                        ->select('subscribes.*', 'users.name as user_name', 'apps.name as app_name', 'packs.pack_name', 'packs.price_pack')
                        ->paginate(20);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'app_name', 'label' => 'Application'],
            ['key' => 'pack_name', 'label' => 'Pack'],
            ['key' => 'user_name', 'label' => 'Customer'],
            ['key' => 'subscribe_start', 'label' => 'Debut abonnement'],
            ['key' => 'subscribe_end', 'label' => 'Fin abonnement'],
            ['key' => 'price_pack', 'label' => 'Montant']
        ];

        return view('livewire.admin.abonnements.abonnement-list', [
            'headers' => $headers,
            'abonnements' => $abonnements
        ]);
    }
}
