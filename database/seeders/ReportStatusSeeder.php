<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportStatusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('report_status')->insert([
            [
                'id_status' => 1,
                'description' => 'Recibido',
            ],
            [
                'id_status' => 2,
                'description' => 'Asignado',
            ],
            [
                'id_status' => 3,
                'description' => 'En proceso',
            ],
            [
                'id_status' => 4,
                'description' => 'Atendido',
            ],
            [
                'id_status' => 5,
                'description' => 'Cancelado',
            ],
            [
                'id_status' => 6,
                'description' => 'Rechazado',
            ],
        ]);
    }
}
