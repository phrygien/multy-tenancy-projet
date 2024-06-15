<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /** @var Tenant $tenant */
        $tenant = Tenant::query()->create(
            attributes: [
                'id' => 'mesoft',
            ],
        );

        $tenant->domains()->create(
            attributes: [
                'domain' => 'mesoft.localhost',
            ],
        );

        Tenant::all()->runForEach(function (Tenant $tenant) {
            $user = User::factory()->create([
                'name' => 'Me Soft',
                'email' => 'me@soft.com',
            ]);

            Team::factory()->for($user)->create([
                'name' => 'Me Soft Co',
                'logo' => null,
                'description' => 'The DevRel Team is awesome'
            ]);
        });
    }
}
