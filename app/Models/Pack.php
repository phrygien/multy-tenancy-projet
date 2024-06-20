<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pack extends Model
{
    use HasFactory;

    public function application(): BelongsTo
    {
        return $this->belongsTo(Apps::class);
    }

    public function modules(): HasMany
    {
        return $this->hasMany(DetailPack::class);
    }

}
