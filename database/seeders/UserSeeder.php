<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Usuario Administrador
        $admin = User::create([
            'name' => 'Roberto Jiménez',
            'email' => 'admin@cafeteriaupds.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin2024'),
            'employee_code' => 'ADM001',
            'department' => 'administracion',
            'phone' => '2-2500001',
            'status' => 'active',
            'last_login_at' => now(),
        ]);

        // 2. Usuario Cocinero/a
        $cook = User::create([
            'name' => 'María Elena Condori',
            'email' => 'cocina@cafeteriaupds.com',
            'email_verified_at' => now(),
            'password' => Hash::make('cocina2024'),
            'employee_code' => 'COC001',
            'department' => 'cocina',
            'phone' => '2-2500002',
            'status' => 'active',
            'last_login_at' => now(),
        ]);

        // 3. Usuario Estudiante - Luciana (Scrum Master)
        $luciana = User::create([
            'name' => 'Luciana Zapana Quispe',
            'email' => 'luciana@upds.edu.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('student2024'),
            'student_code' => '202100001',
            'phone' => '70000001',
            'status' => 'active',
            'last_login_at' => now(),
        ]);

        // 4. Usuario Estudiante - Camila Torres (Persona Primaria)
        $camila = User::create([
            'name' => 'Camila Torres',
            'email' => 'camila@upds.edu.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('student2024'),
            'student_code' => '202100002',
            'phone' => '70000002',
            'status' => 'active',
        ]);

        // 5. Más estudiantes del equipo de desarrollo
        $josue = User::create([
            'name' => 'Josué Escobar Rios',
            'email' => 'josue@upds.edu.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('student2024'),
            'student_code' => '202100003',
            'phone' => '70000003',
            'status' => 'active',
        ]);


        $camilaB = User::create([
            'name' => 'Camila Belén Quispe Aliaga',
            'email' => 'camilab@upds.edu.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('student2024'),
            'student_code' => '202100005',
            'phone' => '70000005',
            'status' => 'active',
        ]);


        $leonardo = User::create([
            'name' => 'Leonardo Arana',
            'email' => 'leonardo@upds.edu.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('student2024'),
            'student_code' => '202100007',
            'phone' => '70000007',
            'status' => 'active',
        ]);

        // Obtener roles
        $adminRole = Role::where('name', Role::ADMIN)->first();
        $kitchenRole = Role::where('name', Role::KITCHEN)->first();
        $studentRole = Role::where('name', Role::STUDENT)->first();

        // Asignar roles
        $admin->assignRole($adminRole);
        $cook->assignRole($kitchenRole);
        
        // Asignar rol de estudiante a todos los estudiantes
        $students = [$luciana, $camila, $josue, $camilaB, $leonardo];
        foreach ($students as $student) {
            $student->assignRole($studentRole);
        }

        // Dar rol adicional de admin a Luciana (como Scrum Master)
        $luciana->assignRole($adminRole, $admin->id);
    }
}