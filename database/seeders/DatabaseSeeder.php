<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        if (app()->isLocal()) {
            $user = User::factory()->create([
                'name' => 'Joao',
                'email' => 'joao@apcas.cat',
                'password' => Hash::make('password')
            ]);

            $user->assignRole($adminRole);
        }
    }
}
