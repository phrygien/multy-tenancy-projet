<?php

namespace Database\Factories;

use App\Models\Domain;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tenant;

class DomainFactory extends Factory
{
    protected $model = Domain::class;

    public function definition()
    {
        return [
            'domain' => $this->faker->domainName,
            'tenant_id' => Tenant::factory(), // Associe chaque domaine à un tenant
        ];
    }
}
