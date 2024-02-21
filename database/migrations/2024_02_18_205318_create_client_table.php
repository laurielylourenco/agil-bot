<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * INSERT INTO cliente (cliente, usuario, sequencia) VALUES (:cliente, :identificador,:sequencia)
     */
    public function up(): void
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string("usuario");
            $table->string("client");
            $table->string("name");
            $table->string("username");
            $table->bigInteger("sequencia");
            $table->foreign('usuario')->references("email")->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
