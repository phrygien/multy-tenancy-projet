<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPack extends Model
{
    use HasFactory;

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

}
