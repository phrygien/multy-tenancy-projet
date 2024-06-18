<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'apps_id',
        'pack_id',
        'subscribe_start',
        'subscribe_end',
        'state'
    ];
}
