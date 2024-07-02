<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = "schools";

    protected $fillable = [
        'school_name',
        'abreviation',
        'identity',
        'url',
        'tenant_id',
        'telephone_fixe',
        'telephone_mobile',
        'email',
        'province_id',
        'region_id',
        'district_id',
        'commune_id',
        'adresse',
        'is_published',
        'user_id',
        'logo'
    ];
}
