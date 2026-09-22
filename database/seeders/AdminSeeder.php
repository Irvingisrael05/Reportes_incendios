<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Buscar el rol administrador
        $adminRole = DB::table('roles')
            ->where('role_type', 'administrador')
            ->first();

        if (!$adminRole) {
            $this->command->error(
                'No existe el rol administrador. Ejecuta primero RoleSeeder.'
            );

            return;
        }

        // Evitar crear el administrador más de una vez
        $existingUser = DB::table('users')
            ->where('username', 'admin')
            ->first();

        if ($existingUser) {
            $this->command->info(
                'El usuario administrador ya existe.'
            );

            return;
        }

        // Crear la persona asociada al administrador
        $personId = DB::table('persons')->insertGetId([
            'first_name'       => 'Administrador',
            'last_name'        => 'CIRFO',
            'middle_name'      => null,
            'phone'            => null,
            'registration_date'=> now(),
            'email'            => 'admin@cirfo.com',
        ]);

        // Crear el usuario administrador
        DB::table('users')->insert([
            'person_id' => $personId,
            'username'  => 'admin',
            'password' => Hash::make('admin123'),
            'status'    => 'active',
            'role_id'   => $adminRole->id_role,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        $this->command->info(
            'Usuario administrador creado correctamente.'
        );
    }
}
