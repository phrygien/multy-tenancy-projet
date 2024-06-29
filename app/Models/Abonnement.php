<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
