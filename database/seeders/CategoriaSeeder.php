<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            ['id' => 1, 'nome' => 'Pintura e Revitalização'],
            ['id' => 2, 'nome' => 'Carpintaria'],
            ['id' => 3, 'nome' => 'Jardinagem e Paisagismo'],
            ['id' => 4, 'nome' => 'Manutenção Elétrica'],
        ]);
    }
}