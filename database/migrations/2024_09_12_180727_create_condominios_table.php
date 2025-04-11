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
        Schema::create('condominios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_sindico');
            $table->string('nome_fantasia');
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            $table->string('uf');
            $table->string('cnpj');
            $table->string('logradouro')->nullable();
            $table->string('complemento_do_endereco')->nullable();
            $table->string('cep')->nullable();
            $table->string('bairro')->nullable();
            $table->date('data_do_cadastro')->nullable();
            $table->date('data_de_desativacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condominios');
    }
};
