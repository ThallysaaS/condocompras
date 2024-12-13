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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('categoria_id') 
                ->constrained('categorias') 
                ->onDelete('cascade');
            $table->foreignId('empresa_id')
                ->constrained('empresas')
                ->onDelete('cascade');
            $table->string('descricao');
            $table->string('custo');
        });

        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreignId('categoria_id') 
                ->constrained('categorias')
                ->onDelete('cascade');
            $table->foreignId('empresa_id')
                ->constrained('empresas')
                ->onDelete('cascade');
            $table->string('descricao');
            $table->string('custo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
        Schema::dropIfExists('servicos');
    }
};