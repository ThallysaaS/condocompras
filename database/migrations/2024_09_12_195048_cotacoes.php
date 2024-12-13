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
        Schema::create('cotacoes', function (Blueprint $table) {
            $table->id();
            $table->date('data_cotacao');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('condominio_id')->nullable()->constrained('condominios')->onDelete('cascade'); // Usando foreignId
            $table->integer('tipo')->default(0);
            $table->string('status');
            $table->timestamps(); // Adiciona created_at e updated_at
        });

        // Tabela historico_cotacoes
        Schema::create('historico_cotacoes', function (Blueprint $table) {
            $table->id();
            $table->date('data_criacao_cotacao');
            $table->foreignId('cotacao_id')->nullable()->constrained('cotacoes')->onDelete('cascade'); // Usando foreignId
            $table->integer('tipo')->default(0);
            $table->string('status');
            $table->timestamps(); // Adiciona created_at e updated_at
        });

        // Tabela itens_cotacoes
        Schema::create('itens_cotacoes', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('produto_id')->constrained('produtos'); // Usando foreignId
            $table->foreignId('servico_id')->nullable()->constrained('servicos')->onDelete('cascade'); // Usando foreignId
            $table->foreignId('condominio_id')->nullable()->constrained('condominios')->onDelete('cascade'); // Usando foreignId
            $table->integer('tipo')->default(0);
            $table->string('status');
            $table->timestamps(); // Adiciona created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_cotacoes');
        Schema::dropIfExists('historico_cotacoes');
        Schema::dropIfExists('cotacoes');
    }
};
