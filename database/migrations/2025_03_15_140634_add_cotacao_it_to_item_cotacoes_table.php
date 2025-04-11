<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('itens_cotacoes', function (Blueprint $table) {
            $table->string('cotacao_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('itens_cotacoes', function (Blueprint $table) {
            $table->dropColumn('cotacao_id');
        });
    }
};
