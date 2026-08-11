<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id_category' => 1,
                'description' => 'Incendio pequeño',
                'image_reference' => null,
            ],
            [
                'id_category' => 2,
                'description' => 'Incendio mediano',
                'image_reference' => null,
            ],
            [
                'id_category' => 3,
                'description' => 'Incendio grande',
                'image_reference' => null,
            ],
        ]);
    }
}
