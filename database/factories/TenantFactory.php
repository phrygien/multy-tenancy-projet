<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
final class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = $this->faker->company;

        return [
            'id' => Str::slug($company),
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'user_id' => \App\Models\User::factory(), // Assumes you have a User factory
            'is_published' => $this->faker->boolean,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Tenant $tenant) {
            $tenant->domains()->save(\App\Models\Domain::factory()->make());
        });
    }
}
