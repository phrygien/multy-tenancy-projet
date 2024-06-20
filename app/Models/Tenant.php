<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

final class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase;
    use HasDomains;
    use HasFactory;

    // protected $fillable = ['tenancy_db_name', 'data'];

    protected $casts = [
        'data' => 'array', // Cast the 'data' column to an array
    ];

    // Accessor for 'tenancy_db_name'
    public function getTenancyDbNameAttribute()
    {
        return $this->data['tenancy_db_name'] ?? null;
    }

    // Define custom columns
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'user_id',
            'is_published',
            'data', // Make sure 'data' column is included
        ];
    }
}
