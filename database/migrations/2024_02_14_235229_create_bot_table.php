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
            $table->string('name_bot');
            $table->timestamps();
            $table->string('usuario');
            $table->string('token');
            $table->string('tipo_bot');
            $table->foreign('usuario')->references("email")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot');
    }
};
