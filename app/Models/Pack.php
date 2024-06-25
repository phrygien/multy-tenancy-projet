<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Illuminate\Support\Facades\DB;
class Pack extends Model
{
    use HasFactory;
    use HasRoles;
    use HasPermissions;

    protected $table = "roles";

    public $fillable = [
        'name',
        'guard_name',
        'amount',
        'app_id'
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(Apps::class, 'app_id');
    }

    public function syncPermissions(array $permissions)
    {
        // Supprimer les permissions existantes pour ce rôle
        DB::table('role_has_permissions')->where('role_id', $this->id)->delete();

        // Ajouter les nouvelles permissions
        $permissionsData = array_map(function ($permissionId) {
            return [
                'role_id' => $this->id,
                'permission_id' => $permissionId
            ];
        }, $permissions);

        DB::table('role_has_permissions')->insert($permissionsData);
    }
}
