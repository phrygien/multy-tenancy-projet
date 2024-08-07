<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Abonnement extends Model
{
    use HasFactory;

    protected $table = "abonnements";

    protected $fillable = [
        'debut',
        'fin',
        'pricing_id',
        'user_id',
        'tenant_id',
        'statut',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pricing(): BelongsTo
    {
        return $this->belongsTo(Pricing::class);
    }
}
