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
        Schema::create('bot', function (Blueprint $table) {
            $table->id();
            $table->string('hash_bot');
            $table->timestamps();
            $table->string('usuario');
            $table->string('token_telegram');
            $table->string('tipo_bot');
            $table->string('descricao');
            $table->string('nome');
            $table->integer('ativo')->default(1); // 1 ativo // 0 desativado 
            $table->foreign('usuario')->references("email")->on("users");
        });

        Schema::table('menu', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bot')->nullable();

            // Adiciona a chave estrangeira
            $table->foreign('id_bot')->references('id')->on('bot')->onDelete('cascade');
        });

        Schema::table('sequencial', function (Blueprint $table) {
            $table->unsignedBigInteger('id_bot')->nullable();

            // Adiciona a chave estrangeira
            $table->foreign('id_bot')->references('id')->on('bot')->onDelete('cascade');
        });
    }


    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu', function (Blueprint $table) {
            $table->dropForeign(['id_bot']);
            $table->dropColumn('id_bot');
        });

        Schema::table('sequencial', function (Blueprint $table) {
            $table->dropForeign(['id_bot']);
            $table->dropColumn('id_bot');
        });

        Schema::dropIfExists('bot');
    }
};
