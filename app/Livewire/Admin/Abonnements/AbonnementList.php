<?php

namespace App\Livewire\Admin\Abonnements;

use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;

class AbonnementList extends Component
{
    public $tenantDatabaseName;

    public $status;
    public $message;
    public $tables;
    public $tenantDbName;

    public function mount()
    {
        //$this->checkPermissions('role-list|role-create|role-edit|role-delete');
        $this->testConnection();
    }

    protected function checkPermissions($permissions)
    {
        $permissions = is_array($permissions) ? $permissions : explode('|', $permissions);

        foreach ($permissions as $permission) {
            if (Auth::user()->can($permission)) {
                return;
            }
        }

        throw new AuthorizationException("Cette action n'est pas autorisée, car vous n'êtes pas abonné à ce module.");
    }

    public function testConnection()
    {
        $user = Auth::user();

        if ($user && $user->tenant) {
            $tenant = $user->tenant;
            $db = 'tenant_' . $tenant->id; //$tenant->id;

            if ($db) {
                try {
                    // Définir dynamiquement la base de données tenant
                    config(['database.connections.tenant.database' => $db]);
                    DB::purge('tenant');
                    DB::reconnect('tenant');

                    // Essayer de se connecter et d'exécuter une simple requête
                    DB::connection('tenant')->getPdo();
                    $this->tables = DB::connection('tenant')->select('SHOW TABLES');
                    $tables = DB::connection('tenant')->select('SHOW TABLES');
                    $tableNames = array_map('current', json_decode(json_encode($tables), true));
                    //dd($tableNames);
                    // Insérer dans la base de données tenant
                    $users = DB::connection('tenant')->table('users')->select('name', 'email', 'password')->get();
                    //dd($users);
                    $this->status = 'success';
                    $this->message = 'Connection to tenant database was successful!';
                } catch (\Exception $e) {
                    $this->status = 'error';
                    $this->message = $e->getMessage();
                }
            } else {
                $this->status = 'error';
                $this->message = 'Tenancy DB name not found.';
            }
        } else {
            $this->status = 'error';
            $this->message = 'User is not associated with a tenant';
        }
    }

    public function render()
    {
        $abonnements = DB::table('subscribes')
            ->join('users', 'users.id', 'subscribes.user_id')
            ->join('apps', 'apps.id', 'subscribes.apps_id')
            ->join('packs', 'packs.id', 'subscribes.pack_id')
            ->select('subscribes.*', 'users.name as user_name', 'apps.name as app_name', 'packs.pack_name', 'packs.price_pack')
            ->paginate(20);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'app_name', 'label' => 'Application'],
            ['key' => 'pack_name', 'label' => 'Pack'],
            ['key' => 'user_name', 'label' => 'Customer'],
            ['key' => 'subscribe_start', 'label' => 'Debut abonnement'],
            ['key' => 'subscribe_end', 'label' => 'Fin abonnement'],
            ['key' => 'price_pack', 'label' => 'Montant'],
            ['key' => 'state', 'label' => 'Statut']
        ];

        return view('livewire.admin.abonnements.abonnement-list', [
            'headers' => $headers,
            'abonnements' => $abonnements,
            'status' => $this->status,
            'message' => $this->message,
            'tables' => $this->tables,
        ]);
    }
}
