<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj')->unique();
            $table->enum('tipo', ['Fornecedor', 'Prestador de Serviço', 'Ambos']);
            $table->date('abertura')->nullable();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('cep');
            $table->string('numero');
            $table->string('logradouro');
            $table->string('bairro');
            $table->string('municipio');
            $table->string('uf');
            $table->string('complemento');
            $table->string('telefone');
            $table->string('email');
            $table->string('atividade_principal')->nullable();
            $table->string('atividade_secundaria')->nullable();
            $table->date('data_do_cadastro');
            $table->date('data_de_desativacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
