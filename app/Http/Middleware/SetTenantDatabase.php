<?php

// app/Http/Middleware/SetTenantDatabase.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SetTenantDatabase
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->tenant) {
            $tenantDbName = $user->tenant->tenancy_db_name;

            config(['database.connections.tenant.database' => $tenantDbName]);
            DB::purge('tenant');
            DB::reconnect('tenant');
            DB::connection('tenant')->getPdo();
        }

        return $next($request);
    }
}

