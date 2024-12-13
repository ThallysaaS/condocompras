<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        // Criando algumas empresas fictícias
        Empresa::create([
            'cnpj' => '12345678000100',
            'nome_fantasia' => 'Empresa A',
            'razao_social' => 'Empresa A Ltda',
            'atividade_principal' => 'Consultoria em TI',
            'telefone' => '11999999999',
            'logradouro' => 'Rua A, 100',
            'numero' => '100',
            'complemento' => 'Sala 101',
            'bairro' => 'Centro',
            'municipio' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01000-000',
            'email' => 'contato@empresaa.com',
            'tipo' => 'Prestador de Serviço',
            'data_do_cadastro' => now(),
        ]);

        Empresa::create([
            'cnpj' => '23456789000101',
            'nome_fantasia' => 'Empresa B',
            'razao_social' => 'Empresa B S/A',
            'atividade_principal' => 'Venda de Materiais de Construção',
            'telefone' => '11988888888',
            'logradouro' => 'Rua B, 200',
            'numero' => '200',
            'complemento' => 'Loja 202',
            'bairro' => 'Jardim Paulista',
            'municipio' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01400-000',
            'email' => 'vendas@empresab.com',
            'tipo' => 'Fornecedor',
            'data_do_cadastro' => now(),
        ]);

        Empresa::create([
            'cnpj' => '34567890000102',
            'nome_fantasia' => 'Empresa C',
            'razao_social' => 'Empresa C LTDA',
            'atividade_principal' => 'Serviços de Limpeza e Conservação',
            'telefone' => '11977777777',
            'logradouro' => 'Rua C, 300',
            'numero' => '300',
            'complemento' => 'Andar 3',
            'bairro' => 'Vila Progredo',
            'municipio' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01500-000',
            'email' => 'contato@empresac.com',
            'tipo' => 'Ambos', // Pode ser fornecedor e prestador de serviços
            'data_do_cadastro' => now(),
        ]);

        Empresa::create([
            'cnpj' => '45678901234503',
            'nome_fantasia' => 'Empresa D',
            'razao_social' => 'Empresa D Comércio',
            'atividade_principal' => 'Venda de Equipamentos Elétricos',
            'telefone' => '11966666666',
            'logradouro' => 'Rua D, 400',
            'numero' => '400',
            'complemento' => 'Loja 404',
            'bairro' => 'Liberdade',
            'municipio' => 'São Paulo',
            'uf' => 'SP',
            'cep' => '01310-000',
            'email' => 'equipamentos@empresad.com',
            'tipo' => 'Fornecedor',
            'data_do_cadastro' => now(),
        ]);
    }
}
