<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anneescolaire extends Model
{
    use HasFactory;

    protected $table ="anneescolaires";

    protected $fillable = [
        'name',
        'debut',
        'fin',
        'is_open',
        'school_id',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
