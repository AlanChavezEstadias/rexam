<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario SuperAdmin
        $superAdmin = User::create([
            'name'     => 'Super Administrador',
            'nickname' => 'superadmin',
            'email'    => 'superadmin@example.com',
            'password' => Hash::make('132'),
        ]);
        $superAdmin->assignRole('SuperAdmin');

        // Usuario Administrador
        $admin = User::create([
            'name'     => 'Administrador',
            'nickname' => 'admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('132'),
        ]);
        $admin->assignRole('Administrador');
    }
}
