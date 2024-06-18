<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apps extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'base_url',
        'description',
        'is_published'
    ];

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class);
    }
}
