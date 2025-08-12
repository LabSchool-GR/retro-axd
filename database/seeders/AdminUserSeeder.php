<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Creates a non-personal demo admin for local/dev and GitHub.
 * Change email/password per environment if needed.
 */
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure User model uses: use Spatie\Permission\Traits\HasRoles;
        $user = User::firstOrCreate(
            ['email' => 'demo@retro-axd.gr'],
            [
                'name' => 'Διαχειριστής',
                'lastname' => 'Καταλόγου',
                'phone' => '0000000000',
                'location' => 'Localhost',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole('admin');
    }
}
