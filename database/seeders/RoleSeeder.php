<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id_role' => 1,
                'role_type' => 'civil',
            ],
            [
                'id_role' => 2,
                'role_type' => 'autoridad',
            ],
            [
                'id_role' => 3,
                'role_type' => 'administrador',
            ],
        ]);
    }
}
