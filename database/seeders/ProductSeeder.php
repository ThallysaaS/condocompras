<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            [
                "nome" => "Tinta Acrílica Premium (Coral Decora)",
                "descricao" => "Pintura de áreas comuns e fachadas.",
                "categoria_id" => 1, // ID da categoria 'Pintura e Revitalização'
                "empresa_id" => 2,
                "custo" => 300,
            ],
            [
                "nome" => "Madeira Tratada Autoclavada",
                "descricao" => "Construção de decks, cercas e móveis externos.",
                "categoria_id" => 2, // ID da categoria 'Carpintaria'
                "empresa_id" => 2,
                "custo" => 50,
            ],
            [
                "nome" => "Grama Esmeralda em Placas",
                "descricao" => "Cobertura de áreas verdes e jardins.",
                "categoria_id" => 3, // ID da categoria 'Jardinagem e Paisagismo'
                "empresa_id" => 4,
                "custo" => 300,
            ],
            [
                "nome" => "Luminária LED de Embutir",
                "descricao" => "Iluminação de áreas comuns e corredores.",
                "categoria_id" => 4, // ID da categoria 'Manutenção Elétrica'
                "empresa_id" => 4,
                "custo" => 80,
            ],
            [
                "nome" => "Adubo Orgânico (Húmus de Minhoca)",
                "descricao" => "Fertilização de jardins e plantas.",
                "categoria_id" => 3, // ID da categoria 'Jardinagem e Paisagismo'
                "empresa_id" => 2,
                "custo" => 25,
            ],
        ]);
    }
}
