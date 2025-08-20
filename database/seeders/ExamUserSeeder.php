<?php
namespace Database\Seeders;

use App\Models\ExamUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ExamUserSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $role = Role::firstOrCreate(
            ['name' => 'Usuario', 'guard_name' => 'exam'],
            ['created_at' => $now, 'updated_at' => $now]
        );

        $student1 = ExamUser::create([
            'nickname'   => 'alumno01',
            'name'       => 'Juan Pérez',
            'email'      => 'juan@example.com',
            'password'   => Hash::make('132'),
            'expires_at' => now()->addDays(7),
        ]);
        $student1->assignRole($role);

        $student2 = ExamUser::create([
            'nickname'   => 'alumno02',
            'name'       => 'Ana Gómez',
            'email'      => 'ana@example.com',
            'password'   => Hash::make('132'),
            'expires_at' => now()->addDays(10),
        ]);
        $student2->assignRole($role);
    }
}
