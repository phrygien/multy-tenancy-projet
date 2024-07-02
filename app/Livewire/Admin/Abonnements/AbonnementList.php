<?php

namespace App\Livewire\Admin\Abonnements;

use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\WithPagination;

class AbonnementList extends Component
{
    USE WithPagination;
    public $tenantDatabaseName;

    public $status;
    public $message;
    public $tables;
    public $tenantDbName;
    public bool $showDrawer2 = false;


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
        $abonnements = DB::table('abonnements')
            ->join('users', 'users.id', 'abonnements.user_id')
            ->join('pricings', 'pricings.id', 'abonnements.pricing_id')
            //->join('packs', 'packs.id', 'subscribes.pack_id')
            ->select('abonnements.*', 'users.name as user_name', 'pricings.name as price_name', 'pricings.price');
            if (1 !== Auth::user()->is_admin) {
                $abonnements->where('users.id', Auth::user()->id);
            }
            $abonnements = $abonnements->paginate(10);

        $headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'tenant_id', 'label' => 'ID PLATEFORME'],
            ['key' => 'debut', 'label' => 'Debut'],
            ['key' => 'fin', 'label' => 'Fin'],
            ['key' => 'user_name', 'label' => 'Responsable'],
            ['key' => 'price_name', 'label' => 'Pack Abonnement'],
            ['key' => 'price', 'label' => 'Montant / Mois'],
            ['key' => 'statut', 'label' => 'Statut Paiement'],
            ['key' => 'is_active', 'label' => 'Etat'],
            ['key' => 'created_at', 'label' => 'Date Creation'],
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
