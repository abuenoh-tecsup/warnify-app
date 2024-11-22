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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario'); // Clave primaria
            $table->string('nombre', 100);
            $table->string('apellidos', 100);
            $table->string('email', 100)->unique();
            $table->string('telefono', 15);
            $table->string('direccion', 100);
            $table->boolean('notifi_acti');
            $table->string('password');
            $table->enum('tipo', ['ciudadano', 'autoridad', 'moderador']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
