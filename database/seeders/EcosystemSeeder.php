<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EcosystemSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ecosystems')->insert([
            [
                'id_ecosystem' => 1,
                'description' => 'Bosque',
            ],
            [
                'id_ecosystem' => 2,
                'description' => 'Pastizal',
            ],
            [
                'id_ecosystem' => 3,
                'description' => 'Matorral',
            ],
            [
                'id_ecosystem' => 4,
                'description' => 'Zona agricola',
            ],
            [
                'id_ecosystem' => 5,
                'description' => 'Otro',
            ],
        ]);
    }
}
