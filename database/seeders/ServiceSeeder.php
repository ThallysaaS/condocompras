<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('servicos')->insert([
            [
                "id" => 1,
                "nome" => "Limpeza e Conservação de Áreas Comuns",
                "descricao" => "Limpeza diária de hall de entrada, corredores, áreas de lazer e piscinas, incluindo remoção de lixo e manutenção das superfícies.",
                "categoria_id" => 1, 
                "empresa_id" => 1,
                "custo" => 1200,
            ],
            [
                "id" => 2,
                "nome" => "Manutenção de Elevadores",
                "descricao" => "Inspeção e manutenção preventiva e corretiva de elevadores, incluindo lubrificação, ajuste e verificação de segurança.",
                "categoria_id" => 2,
                "empresa_id" => 4,
                "custo" => 800,
            ],
            [
                "id" => 3,
                "nome" => "Poda de Árvores e Jardinagem",
                "descricao" => "Poda e manutenção de árvores, corte de grama, adubação e plantio de novas espécies em áreas verdes.",
                "categoria_id" => 3,
                "empresa_id" => 3,
                "custo" => 5000,
            ],
            [
                "id" => 4,
                "nome" => "Instalação de Sistema de Câmeras de Segurança",
                "descricao" => "Instalação de câmeras de vigilância, gravação em HD e configuração de acesso remoto para monitoramento de segurança.",
                "categoria_id" => 4,
                "empresa_id" => 1,
                "custo" => 600,
            ],
            [
                "id" => 5,
                "nome" => "Serviço de Carpintaria",
                "descricao" => "Reparos e construção de estruturas de madeira, incluindo bancos, cercas e portas em áreas comuns do condomínio.",
                "categoria_id" => 3,
                "empresa_id" => 1,
                "custo" => 150,
            ],
        ]);
    }
}
